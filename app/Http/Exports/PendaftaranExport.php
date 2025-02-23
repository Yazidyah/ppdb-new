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
        if ($cell->getColumn() === 'K') { // 'K' adalah kolom "No Telp"
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
                'font' => ['bold' => false],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10, // Kolom "No"
            'B' => 30, // Kolom "Nama Siswa"
            'C' => 20, // Kolom "Tempat Lahir"
            'D' => 20, // Kolom "Tanggal Lahir"
            'E' => 15, // Kolom "Jenis Kelamin"
            'F' => 15, // Kolom "Rombe"
            'G' => 30, // Kolom "Nama Orang Tua"
            'H' => 20, // Kolom "Agama"
            'I' => 25, // Kolom "Pekerjaan"
            'J' => 25, // Kolom "Pendidikan"
            'K' => 20, // Kolom "No. Telp"
            'L' => 15, // Kolom "No Induk"
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Siswa',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Rombe',
            'Nama Orang Tua',
            'Agama',
            'Pekerjaan',
            'Pendidikan',
            'No. Telp',
            'No Induk',
        ];
    }
    public function collection()
    {
        return $this->exportedCollection->lazy();
    }
}
