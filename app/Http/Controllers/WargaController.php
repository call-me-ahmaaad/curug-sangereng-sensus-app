<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Warga;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{
    public function web_warga_index()
    {
        return view('beranda');
    }

    public function web_warga_data_download()
    {
        $tahunData_keluarga = Keluarga::select('tahun_data')->distinct()->pluck('tahun_data');
        $tahunData_warga = Warga::select('tahun_data')->distinct()->pluck('tahun_data');

        return view('unduh_data', compact('tahunData_keluarga', 'tahunData_warga'));
    }

    public function web_warga_add()
    {
        return view('tambah_data');
    }

    public function web_warga_store()
    {

    }

    public function web_warga_edit_index()
    {
        return view('edit_data');
    }

    public function web_warga_edit()
    {

    }

    public function web_warga_update()
    {

    }

    public function web_warga_delete()
    {

    }

    public function web_warga_destroy()
    {

    }

    // * Untuk sementara pengaturan akun ada di sini dulu.
    public function web_admin_profile()
    {
        return view('admin');
    }
}
