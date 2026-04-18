<?php

namespace App\Services;

use App\Models\DataSekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DataSekolahService
{
    public function getOrFetchByNpsn(string $npsn): ?DataSekolah
    {
        $npsn = trim($npsn);
        if ($npsn === '' || !preg_match('/^\d{1,8}$/', $npsn)) {
            throw new \InvalidArgumentException('NPSN harus berupa angka dengan maksimal 8 digit.');
        }
        $allowedBentuk = ['SMP', 'MTS'];

        $existing = DataSekolah::where('npsn', $npsn)->first();
        if ($existing) {
            if (empty($existing->bentuk_sekolah)) {
                if ($scraped = $this->fetchNpsnFromHtml($npsn)) {
                    $bentuk = strtoupper(trim((string)($scraped['bentukPendidikan'] ?? '')));
                    $existing->setAttribute('bentuk_sekolah', $scraped['bentukPendidikan'] ?? null);
                    if (in_array($bentuk, $allowedBentuk, true)) {
                        $update = [
                            'sekolah_asal' => $scraped['schoolName'] ?? $existing->sekolah_asal,
                            'status_sekolah' => $scraped['statusSekolah'] ?? $existing->status_sekolah,
                            'predikat_akreditasi_sekolah' => $scraped['predikatAkreditasi'] ?? $existing->predikat_akreditasi_sekolah,
                            'bentuk_sekolah' => $scraped['bentukPendidikan'] ?? null,
                        ];
                        try {
                            DB::transaction(function () use ($npsn, $update) {
                                DataSekolah::updateOrCreate(['npsn' => $npsn], $update);
                            });
                            $existing = DataSekolah::where('npsn', $npsn)->first();
                        } catch (\Throwable $e) {
                            Log::warning('Gagal memperbarui bentuk_sekolah saat enrich', ['npsn' => $npsn, 'error' => $e->getMessage()]);
                        }
                    } else {
                        Log::info('NPSN bentuk tidak diizinkan saat enrich; skip persist', ['npsn' => $npsn, 'bentuk' => $bentuk]);
                    }
                }
            }
            return $existing;
        }

        $scraped = $this->fetchNpsnFromHtml($npsn);
        if (!$scraped || empty($scraped['npsn'])) {
            return null;
        }

        $payload = [
            'npsn' => $scraped['npsn'],
            'sekolah_asal' => $scraped['schoolName'] ?? null,
            'status_sekolah' => $scraped['statusSekolah'] ?? null,
            'predikat_akreditasi_sekolah' => $scraped['predikatAkreditasi'] ?? null,
            'bentuk_sekolah' => $scraped['bentukPendidikan'] ?? null,
        ];

        $bentuk = strtoupper(trim((string)($scraped['bentukPendidikan'] ?? '')));
        if (!in_array($bentuk, $allowedBentuk, true)) {
            Log::info('NPSN bentuk tidak diizinkan; tidak dipersist ke data_sekolah', ['npsn' => $npsn, 'bentuk' => $bentuk]);
            return new DataSekolah($payload);
        }

        try {
            return DB::transaction(function () use ($npsn, $payload) {
                DataSekolah::updateOrCreate(['npsn' => $npsn], $payload);
                return DataSekolah::where('npsn', $npsn)->first();
            });
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan DataSekolah', [
                'npsn' => $npsn,
                'error' => $e->getMessage(),
            ]);
            return DataSekolah::where('npsn', $npsn)->first();
        }
    }

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

            $bentukNode = $xpath->query("//td[contains(text(), 'Bentuk Pendidikan')]/following-sibling::td[2]")->item(0);
            $bentukPendidikan = $bentukNode ? trim($bentukNode->nodeValue) : null;

            $predikatNode = $xpath->query("//td[contains(text(), 'Akreditasi')]/following-sibling::td[2]")->item(0);
            $predikatAkreditasi = $predikatNode ? trim($predikatNode->nodeValue) : null;

            $nilaiNode = $xpath->query("//td[contains(text(), 'Nilai Akreditasi')]/following-sibling::td[2]")->item(0);
            $nilaiAkreditasi = $nilaiNode ? trim($nilaiNode->nodeValue) : null;

            return [
                'npsn' => $npsnVal,
                'schoolName' => $schoolName,
                'statusSekolah' => $statusSekolah,
                'bentukPendidikan' => $bentukPendidikan,
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
