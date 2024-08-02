<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WargaExport implements FromCollection, WithHeadings
{
    protected $tahun_data;

    public function __construct($tahun_data)
    {
        $this->tahun_data = $tahun_data;
    }

    public function collection()
    {
        return Warga::with(['keluarga' => function($query) {
            $query->select('no_kk', 'kepala_keluarga', 'rt', 'rw', 'status_pkh');
        }])
        ->where('tahun_data', $this->tahun_data)
        ->get()
        ->map(function ($item) {
            return [
                'NIK' => "'" . $item->nik, // Add apostrophe to NIK
                'No Akta Lahir' => $item->no_akta_lahir,
                'No KK' => "'" . $item->no_kk, // Add apostrophe to No KK
                'Nama' => $item->nama,
                'Punya KTP' => $item->punya_ktp ? 'Ya' : 'Tidak',
                'Status JKN' => $item->status_jkn,
                'Tempat Lahir' => $item->tempatLahir->tempat_lahir ?? '',
                'Tanggal Lahir' => $item->tanggal_lahir,
                'Jenis Kelamin' => $item->jenis_kelamin,
                'Agama' => $item->agama,
                'Golongan Darah' => $item->golongan_darah,
                'Pendidikan' => $item->pendidikan,
                'Pekerjaan' => $item->pekerjaan,
                'Status Nikah' => $item->status_nikah,
                'Status Keluarga' => $item->status_keluarga,
                'Kewarganegaraan' => $item->kewarganegaraan,
                'Nama Ibu' => $item->nama_ibu,
                'Tahun Data' => $item->tahun_data,
                'Kepala Keluarga' => $item->keluarga->kepala_keluarga ?? '',
                'RT' => $item->keluarga->rt ?? '',
                'RW' => $item->keluarga->rw ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIK',
            'No Akta Lahir',
            'No KK',
            'Nama',
            'Punya KTP',
            'Status JKN',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Agama',
            'Golongan Darah',
            'Pendidikan',
            'Pekerjaan',
            'Status Nikah',
            'Status Keluarga',
            'Kewarganegaraan',
            'Nama Ibu',
            'Tahun Data',
            'Kepala Keluarga',
            'RT',
            'RW',
        ];
    }
}
