<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class PendaftaranExport extends DefaultValueBinder implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnWidths,
    WithStrictNullComparison,
    WithCustomValueBinder
{
    use Exportable;
    public $exportedCollection;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($exportedCollection)
    {
        $this->exportedCollection = $exportedCollection;
    }
    public function bindValue(Cell $cell, $value)
    {
        // Jika kolom adalah nomor telepon, set sebagai string
        if ($cell->getColumn() === 'J') { // 'J' adalah kolom "No Telp"
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
            return true;
        }

        if ($cell->getColumn() === 'K') { // 'K' adalah kolom "NIK"
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
            return true;
        }

        if ($cell->getColumn() === 'C') { // 'C' adalah kolom "NISN"
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
            return true;
        }

        if ($cell->getColumn() === 'U') { // 'C' adalah kolom "NISN"
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
            return true;
        }

        if ($cell->getColumn() === 'V') { // 'C' adalah kolom "NISN"
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
            return true;
        }

        if ($cell->getColumn() === 'Q') { // 'C' adalah kolom "NISN"
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
            return true;
        }

        if ($cell->getColumn() === 'R') { // 'C' adalah kolom "NISN"
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
            return true;
        }

        // Untuk nilai numerik lainnya
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);
            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function styles(Worksheet $sheet)
    {
        // Set style for the first row (heading)
        // $sheet->getRowDimension(1)->setRowHeight(25); // Atur tinggi heading menjadi 25

        // return [
        //     1 => [
        //         'font' => ['bold' => true],
        //         'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        //     ],
        // ];

        $sheet->getRowDimension(1)->setRowHeight(25); // Atur tinggi heading menjadi 25

        $sheet->getStyle('A1:BK1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '4F81BD'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Set style for all rows
        $sheet->getStyle('A2:BK' . $sheet->getHighestRow())->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 20,
            'R' => 20,
            'S' => 20,
            'T' => 20,
            'U' => 20,
            'V' => 20,
            'W' => 20,
            'X' => 20,
            'Y' => 20,
            'Z' => 20,
            'AA' => 20,
            'AB' => 20,
            'AC' => 20,
            'AD' => 20,
            'AE' => 20,
            'AF' => 20,
            'AG' => 20,
            'AH' => 10,
            'AI' => 10,
            'AJ' => 10,
            'AK' => 10,
            'AL' => 10,
            'AM' => 10,
            'AN' => 10,
            'AO' => 10,
            'AP' => 10,
            'AQ' => 10,
            'AR' => 10,
            'AS' => 10,
            'AT' => 10,
            'AU' => 10,
            'AV' => 10,
            'AW' => 10,
            'AX' => 10,
            'AY' => 10,
            'AZ' => 10,
            'BA' => 10,
            'BB' => 10,
            'BC' => 10,
            'BD' => 10,
            'BE' => 10,
            'BF' => 10,
            'BG' => 10,
            'BH' => 10,
            'BI' => 10,
            'BJ' => 10,
            'BK' => 10,
        ];
    }

    public function headings(): array
    {
        return [
            'No', //A
            'Jalur', //B
            'NISN', //C
            'No. Pendaftaran', //D
            'Sekolah Asal', //E
            'Nama', //F
            'POB', //G
            'DOB', //H
            'Email', //I
            'Telp', //J
            'NIK', //K
            'Gender', //L
            'Alamat', //M
            'Domisili', //N
            'Ayah', //O
            'Pekerjaan Ayah', //P
            'NIK Ayah', //Q
            'Telp Ayah', //R
            'Ibu', //S
            'Pekerjaan Ibu', //T
            'NIK Ibu', //U
            'Telp Ibu', //V
            'Wali', //W
            'Pekerjaan Wali', //X
            'NIK Wali', //Y
            'Telp Wali', //Z
            'No KK', //AA
            'Akreditasi Sekolah (Nilai)', //AB
            'Akreditasi Sekolah (Predikat)', //AC
            'Posisi', //AD
            'Status Verifikasi', //AE
            'Status Penerimaan', //AF
            'Nomor Suket', //AG
            //semester 1
            'Eng 1', //AH
            'Mat 1', //AI
            'Ind 1', //AJ
            'IPA 1', //AK
            'IPS 1', //AL
            'PAI 1', //AM
            //semester 2
            'Eng 2', //AN
            'Mat 2', //AO
            'Ind 2', //AP
            'IPA 2', //AQ
            'IPS 2', //AR
            'PAI 2', //AS
            //semester 3
            'Eng 3', //AT
            'Mat 3', //AU
            'Ind 3', //AV
            'IPA 3', //AW
            'IPS 3', //AX
            'PAI 3', //AY
            // semester 4
            'Eng 4', //AZ
            'Mat 4', //BA
            'Ind 4', //BB
            'IPA 4', //BC
            'IPS 4', //BD
            'PAI 4', //BE
            // semeseter 5
            'Eng 5', //BF
            'Mat 5', //BG
            'Ind 5', //BH
            'IPA 5', //BI
            'IPS 5', //BJ
            'PAI 5', //BK
        ];
    }
    public function collection()
    {
        return $this->exportedCollection->lazy();
    }
}
