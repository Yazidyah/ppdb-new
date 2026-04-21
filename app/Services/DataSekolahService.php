<?php

namespace App\Services;

use App\Models\DataSekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
            $response = null;

            try {
                $response = Http::timeout(20)
                    ->accept('text/html,application/xhtml+xml')
                    ->get($url);
            } catch (\Throwable $e) {
                Log::warning('NPSN API request failed', ['url' => $url, 'error' => $e->getMessage()]);
                $response = null;
            }

            if (($response === null || !$response->successful()) && app()->isLocal()) {
                // Fallback local-dev when host CA bundle is not configured.
                $response = Http::withoutVerifying()
                    ->timeout(20)
                    ->accept('text/html,application/xhtml+xml')
                    ->get($url);
            }

            if ($response === null || !$response->successful()) {
                Log::warning('Gagal mengambil HTML referensi NPSN', [
                    'url' => $url,
                    'status' => $response?->status(),
                ]);
                return null;
            }

            $html = $response->body();
            if ($html === '') {
                Log::warning('HTML referensi NPSN kosong', ['url' => $url]);
                return null;
            }

            $dom = new \DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new \DOMXPath($dom);

            $schoolName = $this->extractTableValue($xpath, 'Nama');
            $statusSekolah = $this->extractTableValue($xpath, 'Status Sekolah');
            $bentukPendidikan = $this->extractTableValue($xpath, 'Bentuk Pendidikan');
            $predikatAkreditasi = $this->extractTableValue($xpath, 'Akreditasi');
            $nilaiAkreditasi = $this->extractTableValue($xpath, 'Nilai Akreditasi');

            $npsnAnchorNode = $xpath->query("//td[normalize-space(.)='NPSN']/following-sibling::td[last()]//a")->item(0);
            $npsnVal = $npsnAnchorNode ? trim($npsnAnchorNode->nodeValue) : null;
            if ($npsnVal === null || !preg_match('/^\d{8}$/', $npsnVal)) {
                // Fallback if page structure shifts slightly.
                $npsnVal = $this->extractTableValue($xpath, 'NPSN');
            }

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

    private function extractTableValue(\DOMXPath $xpath, string $label): ?string
    {
        $query = "//td[normalize-space(.)='{$label}']/following-sibling::td[last()]";
        $node = $xpath->query($query)->item(0);
        if (!$node) {
            return null;
        }
        $value = trim($node->textContent);
        return $value === '' ? null : $value;
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
