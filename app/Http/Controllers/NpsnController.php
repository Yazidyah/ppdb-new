<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NpsnController extends Controller
{
    public function fetchNpsnFromHtml($url)
    {
        $html = file_get_contents($url);
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);
        
        $npsnNode = $xpath->query("//a[@class='link1']")->item(0);
        $npsn = $npsnNode ? $npsnNode->nodeValue : null;

        $nameNode = $xpath->query("//td[contains(text(), 'Nama')]/following-sibling::td[2]")->item(0);
        $schoolName = $nameNode ? $nameNode->nodeValue : null;

        $tingkatPendidikanNode = $xpath->query("//td[contains(text(), 'Bentuk Pendidikan')]/following-sibling::td[2]")->item(0);
        $tingkatPendidikan = $tingkatPendidikanNode ? $tingkatPendidikanNode->nodeValue : null;

        return [
            'nama_sekolah' => $schoolName,
            'npsn' => $npsn,
            'tingkat_pendidikan' => $tingkatPendidikan,
        ];
    }

    public function getNpsn(Request $request)
    {
        $npsn = $request->input('npsn');
        if (!$npsn) {
            return response()->json(['error' => 'NPSN is required'], 400);
        }

        $url = "https://referensi.data.kemdikbud.go.id/pendidikan/npsn/{$npsn}";
        $data = $this->fetchNpsnFromHtml($url);
        if ($data['npsn']) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'NPSN not found'], 404);
        }
    }
}
