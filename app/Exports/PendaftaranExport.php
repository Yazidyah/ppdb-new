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
        $sheet->getRowDimension(1)->setRowHeight(25); // Atur tinggi heading menjadi 25

        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ],
        ];
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
        ];
    }

    public function headings(): array
    {
        return [
            'No', //A
            'Jalur', //B
            'NISN', //c
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
            'Domisili', //O
            'Ayah', //P
            'Pekerjaan Ayah', //Q
            'NIK Ayah', //R
            'Telp Ayah', //S
            'Ibu', //T
            'Pekerjaan Ibu', //U
            'NIK Ibu', //V
            'Telp Ibu', //W
            'Wali', //X
            'Pekerjaan Wali', //Y
            'NIK Wali', //Z
            'Telp Wali', //AA
        ];
    }
    public function collection()
    {
        return $this->exportedCollection->lazy();
    }
}
