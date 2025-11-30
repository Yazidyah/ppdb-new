<?php

namespace App\Services;

use App\Models\DataSekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DataSekolahService
{
    /**
     * Contract
     * - Input: numeric NPSN (string or int, up to 8 digits)
     * - Output: DataSekolah model instance (persisted)
     * - Errors: throws \InvalidArgumentException for invalid input; returns existing data on scrape failure if present
     */
    public function getOrFetchByNpsn(string $npsn): ?DataSekolah
    {
        $npsn = trim($npsn);
        if ($npsn === '' || !preg_match('/^\d{1,8}$/', $npsn)) {
            throw new \InvalidArgumentException('NPSN harus berupa angka dengan maksimal 8 digit.');
        }

        // 1) DB-first lookup
        $existing = DataSekolah::where('npsn', $npsn)->first();
        if ($existing) {
            return $existing; // No external request if found
        }

        // 2) Fetch externally and persist atomically
        $scraped = $this->fetchNpsnFromHtml($npsn);
        if (!$scraped || empty($scraped['npsn'])) {
            // If scraping failed and nothing in local DB, return null (caller can decide fallback UX)
            return null;
        }

        // Normalize payload to DataSekolah schema
        $payload = [
            'npsn' => $scraped['npsn'],
            'sekolah_asal' => $scraped['schoolName'] ?? null,
            'status_sekolah' => $scraped['statusSekolah'] ?? null,
            'predikat_akreditasi_sekolah' => $scraped['predikatAkreditasi'] ?? null,
            'nilai_akreditasi_sekolah' => $this->toNullableInt($scraped['nilaiAkreditasi'] ?? null),
        ];

        try {
            return DB::transaction(function () use ($npsn, $payload) {
                // Upsert by unique npsn
                DataSekolah::updateOrCreate(['npsn' => $npsn], $payload);
                return DataSekolah::where('npsn', $npsn)->first();
            });
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan DataSekolah', [
                'npsn' => $npsn,
                'error' => $e->getMessage(),
            ]);
            // If upsert fails but we later have a partial record, try read once more
            return DataSekolah::where('npsn', $npsn)->first();
        }
    }

    /**
     * Scrape Referensi Data Kemdikbud for NPSN details.
     * Kept here to centralize side-effects; callers should not use this directly.
     */
    private function fetchNpsnFromHtml(string $npsn): ?array
    {
        $baseUrl = env('NPSN_API_BASE_URL');
        if (!$baseUrl) {
            Log::warning('NPSN_API_BASE_URL tidak diset di env.');
            return null;
        }
        $url = rtrim($baseUrl, '/') . '/' . $npsn;

        try {
            $html = @file_get_contents($url);
            if ($html === false || $html === null) {
                Log::warning('Gagal mengambil HTML referensi NPSN', ['url' => $url]);
                return null;
            }

            $dom = new \DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new \DOMXPath($dom);

            $npsnNode = $xpath->query("//a[@class='link1']")->item(0);
            $npsnVal = $npsnNode ? trim($npsnNode->nodeValue) : null;

            $nameNode = $xpath->query("//td[contains(text(), 'Nama')]/following-sibling::td[2]")->item(0);
            $schoolName = $nameNode ? trim($nameNode->nodeValue) : null;

            $statusNode = $xpath->query("//td[contains(text(), 'Status Sekolah')]/following-sibling::td[2]")->item(0);
            $statusSekolah = $statusNode ? trim($statusNode->nodeValue) : null;

            // Optional: Akreditasi nodes; keep best-effort
            $predikatNode = $xpath->query("//td[contains(text(), 'Akreditasi')]/following-sibling::td[2]")->item(0);
            $predikatAkreditasi = $predikatNode ? trim($predikatNode->nodeValue) : null;

            $nilaiNode = $xpath->query("//td[contains(text(), 'Nilai Akreditasi')]/following-sibling::td[2]")->item(0);
            $nilaiAkreditasi = $nilaiNode ? trim($nilaiNode->nodeValue) : null;

            return [
                'npsn' => $npsnVal,
                'schoolName' => $schoolName,
                'statusSekolah' => $statusSekolah,
                'predikatAkreditasi' => $predikatAkreditasi,
                'nilaiAkreditasi' => $nilaiAkreditasi,
            ];
        } catch (\Throwable $e) {
            Log::error('Exception saat scraping NPSN', [
                'url' => $url,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    private function toNullableInt($value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }
        if (is_numeric($value)) {
            return (int) $value;
        }
        return null;
    }
}
