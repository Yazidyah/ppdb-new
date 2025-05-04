<?php

namespace App\Helpers;

class DocumentHelper
{
    public static function isSimpleSyarat($namaSyarat) // syarat ga butuh ngisi data
    {
        $syaratKeyword = ['foto', 'pas foto', 'akta kelahiran', 'rapot', 'raport', 'rapor', 'Sertifikat', 'KIP/KKS/PKH', 'Tabungan'];
        foreach ($syaratKeyword as $keyword) {
            if (stripos($namaSyarat, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }
}
