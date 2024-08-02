<?php

namespace App\Http\Controllers;

use App\Exports\KeluargaExport;
use App\Exports\WargaExport;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    // Fungsi untuk fitur download data keluarga
    public function keluarga_export($tahun_data)
    {
        return Excel::download(new KeluargaExport($tahun_data), 'keluarga_' . $tahun_data . '.xlsx');
    }

    // Fungsi untuk fitur download data warga
    public function warga_export($tahun_data)
    {
        return Excel::download(new WargaExport($tahun_data), 'warga_' . $tahun_data . '.xlsx');
    }
}
