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
        $result = $this->getOrFetchByNpsnResult($npsn);
        return $result['data'];
    }

    public function getOrFetchByNpsnResult(string $npsn): array
    {
        $npsn = trim($npsn);
        if ($npsn === '' || !preg_match('/^[A-Za-z0-9]{1,10}$/', $npsn)) {
            throw new \InvalidArgumentException('NPSN harus berupa huruf/angka dengan maksimal 10 karakter.');
        }

        $existing = DataSekolah::where('npsn', $npsn)->first();
        $foundJenjang = null;
        if ($existing) {
            $existingBentuk = strtoupper(trim((string) $existing->bentuk_sekolah));
            if (
                empty($existing->bentuk_sekolah)
                || in_array($existingBentuk, ['SKB', 'PKBM'], true)
                || str_contains($existingBentuk, 'PONDOK')
            ) {
                $fetchResult = $this->fetchNpsnFromHtmlDetailed($npsn);
                if ($fetchResult['status'] === 'ok' && $fetchResult['data']) {
                    $scraped = $fetchResult['data'];
                    $bentuk = strtoupper(trim((string)($scraped['bentukPendidikan'] ?? '')));
                    $programLayanan = $scraped['programLayanan'] ?? null;
                    $jenjang = strtoupper(trim((string)($scraped['jenjangPendidikan'] ?? '')));
                    $foundJenjang = $jenjang;
                    $bentukForStorage = $this->normalizeBentukForStorage($bentuk, $programLayanan, $jenjang);
                    $existing->setAttribute('bentuk_sekolah', $bentukForStorage);
                    if ($this->isAllowedBentuk($bentuk, $programLayanan, $jenjang)) {
                        $update = [
                            'sekolah_asal' => $scraped['schoolName'] ?? $existing->sekolah_asal,
                            'status_sekolah' => $scraped['statusSekolah'] ?? $existing->status_sekolah,
                            'predikat_akreditasi_sekolah' => $scraped['predikatAkreditasi'] ?? $existing->predikat_akreditasi_sekolah,
                            'bentuk_sekolah' => $bentukForStorage,
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
                        Log::info('NPSN bentuk tidak diizinkan saat enrich; skip persist', ['npsn' => $npsn, 'bentuk' => $bentuk, 'program_layanan' => $programLayanan]);
                    }
                }
            }
            return [
                'status' => 'ok',
                'data' => $existing,
                'jenjangPendidikan' => $foundJenjang,
            ];
        }

        $fetchResult = $this->fetchNpsnFromHtmlDetailed($npsn);
        if ($fetchResult['status'] !== 'ok') {
            return [
                'status' => $fetchResult['status'],
                'data' => null,
            ];
        }

        $scraped = $fetchResult['data'];
        if (!$scraped || empty($scraped['npsn'])) {
            return [
                'status' => 'not_found',
                'data' => null,
            ];
        }

        $bentuk = strtoupper(trim((string)($scraped['bentukPendidikan'] ?? '')));
        $programLayanan = $scraped['programLayanan'] ?? null;
        $jenjang = strtoupper(trim((string)($scraped['jenjangPendidikan'] ?? '')));
        $foundJenjang = $jenjang;
        $bentukForStorage = $this->normalizeBentukForStorage($bentuk, $programLayanan, $jenjang);

        $payload = [
            'npsn' => $scraped['npsn'],
            'sekolah_asal' => $scraped['schoolName'] ?? null,
            'status_sekolah' => $scraped['statusSekolah'] ?? null,
            'predikat_akreditasi_sekolah' => $scraped['predikatAkreditasi'] ?? null,
            'bentuk_sekolah' => $bentukForStorage,
        ];

        if (!$this->isAllowedBentuk($bentuk, $programLayanan, $jenjang)) {
            Log::info('NPSN bentuk tidak diizinkan; tidak dipersist ke data_sekolah', ['npsn' => $npsn, 'bentuk' => $bentuk, 'program_layanan' => $programLayanan, 'jenjang' => $jenjang]);
            return [
                'status' => 'ok',
                'data' => new DataSekolah($payload),
                'jenjangPendidikan' => $foundJenjang,
            ];
        }

        try {
            $stored = DB::transaction(function () use ($npsn, $payload) {
                DataSekolah::updateOrCreate(['npsn' => $npsn], $payload);
                return DataSekolah::where('npsn', $npsn)->first();
            });

            return [
                'status' => 'ok',
                'data' => $stored,
                'jenjangPendidikan' => $foundJenjang,
            ];
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan DataSekolah', [
                'npsn' => $npsn,
                'error' => $e->getMessage(),
            ]);
            return [
                'status' => 'ok',
                'data' => DataSekolah::where('npsn', $npsn)->first(),
                'jenjangPendidikan' => $foundJenjang,
            ];
        }
    }

    private function fetchNpsnFromHtml(string $npsn): ?array
    {
        $result = $this->fetchNpsnFromHtmlDetailed($npsn);
        return $result['status'] === 'ok' ? $result['data'] : null;
    }

    private function fetchNpsnFromHtmlDetailed(string $npsn): array
    {
        $baseUrl = config('services.npsn.base_url');
        if (!$baseUrl) {
            Log::warning('NPSN_API_BASE_URL tidak diset di env.');
            return [
                'status' => 'service_down',
                'data' => null,
            ];
        }
        $url = rtrim($baseUrl, '/') . '/' . $npsn;

        $response = null;
        $requestFailed = false;

        try {
            $response = Http::timeout(20)
                ->accept('text/html,application/xhtml+xml')
                ->get($url);
        } catch (\Throwable $e) {
            Log::warning('NPSN API request failed', ['url' => $url, 'error' => $e->getMessage()]);
            $response = null;
            $requestFailed = true;
        }

        if (($response === null || !$response->successful()) && app()->isLocal()) {
            // Fallback local-dev when host CA bundle is not configured.
            try {
                $response = Http::withoutVerifying()
                    ->timeout(20)
                    ->accept('text/html,application/xhtml+xml')
                    ->get($url);
                $requestFailed = false;
            } catch (\Throwable $e) {
                Log::warning('NPSN API request failed without TLS verification', ['url' => $url, 'error' => $e->getMessage()]);
                $response = null;
                $requestFailed = true;
            }
        }

        if ($response === null || !$response->successful()) {
            $statusCode = $response?->status();
            Log::warning('Gagal mengambil HTML referensi NPSN', [
                'url' => $url,
                'status' => $statusCode,
            ]);

            $isServiceDown = $requestFailed || $statusCode === null || $statusCode >= 500;
            return [
                'status' => $isServiceDown ? 'service_down' : 'not_found',
                'data' => null,
            ];
        }

        $html = $response->body();
        if ($html === '') {
            Log::warning('HTML referensi NPSN kosong', ['url' => $url]);
            return [
                'status' => 'not_found',
                'data' => null,
            ];
        }

        try {
            $dom = new \DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new \DOMXPath($dom);

            $schoolName = $this->extractTableValue($xpath, 'Nama');
            $statusSekolah = $this->extractTableValue($xpath, 'Status Sekolah');
            $bentukPendidikan = $this->extractTableValue($xpath, 'Bentuk Pendidikan');
            $programLayanan = $this->extractTableValue($xpath, 'Program / Layanan')
                ?? $this->extractTableValue($xpath, 'Program/Layanan');
            $jenjangPendidikan = $this->extractTableValue($xpath, 'Jenjang Pendidikan');
            $predikatAkreditasi = $this->extractTableValue($xpath, 'Akreditasi');
            $nilaiAkreditasi = $this->extractTableValue($xpath, 'Nilai Akreditasi');

            $npsnAnchorNode = $xpath->query("//td[normalize-space(.)='NPSN']/following-sibling::td[last()]//a")->item(0);
            $npsnVal = $npsnAnchorNode ? trim($npsnAnchorNode->nodeValue) : null;
            if ($npsnVal === null || !preg_match('/^\d{8}$/', $npsnVal)) {
                // Fallback if page structure shifts slightly.
                $npsnVal = $this->extractTableValue($xpath, 'NPSN');
            }

            if ($npsnVal === null || !preg_match('/^\d{8}$/', (string) $npsnVal)) {
                return [
                    'status' => 'not_found',
                    'data' => null,
                ];
            }

            return [
                'status' => 'ok',
                'data' => [
                    'npsn' => $npsnVal,
                    'schoolName' => $schoolName,
                    'statusSekolah' => $statusSekolah,
                    'bentukPendidikan' => $bentukPendidikan,
                    'programLayanan' => $programLayanan,
                    'jenjangPendidikan' => $jenjangPendidikan,
                    'predikatAkreditasi' => $predikatAkreditasi,
                    'nilaiAkreditasi' => $nilaiAkreditasi,
                ],
            ];
        } catch (\Throwable $e) {
            Log::error('Exception saat scraping NPSN', [
                'url' => $url,
                'error' => $e->getMessage(),
            ]);
            return [
                'status' => 'not_found',
                'data' => null,
            ];
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

    private function isAllowedBentuk(?string $bentuk, ?string $programLayanan = null, ?string $jenjang = null): bool
    {
        $bentuk = strtoupper(trim((string) $bentuk));
        $jenjang = strtoupper(trim((string) $jenjang));

        if (in_array($bentuk, ['SMP', 'MTS'], true)) {
            return true;
        }

        if (in_array($bentuk, ['SKB', 'PKBM'], true)) {
            $program = strtoupper((string) $programLayanan);
            return str_contains($program, 'PAKET B');
        }

        if (str_contains($bentuk, 'PONDOK')) {
            return $jenjang === 'DIKDAS';
        }

        return false;
    }

    private function normalizeBentukForStorage(?string $bentuk, ?string $programLayanan = null, ?string $jenjang = null): ?string
    {
        $normalized = strtoupper(trim((string) $bentuk));
        if ($normalized === '') {
            return null;
        }

        if (in_array($normalized, ['SKB', 'PKBM'], true) && $this->isAllowedBentuk($normalized, $programLayanan, $jenjang)) {
            return 'SMP';
        }

        return $normalized;
    }
}
