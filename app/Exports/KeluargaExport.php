<?php

namespace App\Exports;

use App\Models\Keluarga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class KeluargaExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    protected $tahun_data;

    public function __construct($tahun_data)
    {
        $this->tahun_data = $tahun_data;
    }

    public function collection()
    {
        return Keluarga::where('tahun_data', $this->tahun_data)->get()->map(function($item) {
            $item->no_kk = "'" . $item->no_kk; // Add apostrophe to no_kk
            $item->status_pkh = $item->status_pkh == 1 ? 'PENERIMA' : 'BUKAN PENERIMA'; // Change status_pkh
            return [
                $item->no_kk,
                $item->kepala_keluarga,
                $item->status_pkh,
                $item->rt,
                $item->rw,
                $item->tahun_data,
            ]; // Return array without created_at and updated_at
        });
    }

    public function headings(): array
    {
        return [
            'No KK',
            'Kepala Keluarga',
            'Status PKH',
            'RT',
            'RW',
            'Tahun Data',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT, // Format column A (No KK) as text
        ];
    }
}
