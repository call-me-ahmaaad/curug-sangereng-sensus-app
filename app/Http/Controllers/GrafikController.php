<?php

namespace App\Http\Controllers;

// Package List
use Carbon\Carbon;

// Model List
use App\Models\Keluarga;
use App\Models\Warga;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GrafikController extends Controller
{
    // Fungsi untuk mengambil data gender
    public function grafik_gender()
    {
        $currentYear = Carbon::now()->year;

        try {
            // Query untuk mendapatkan data jumlah laki-laki dan perempuan per RW
            $dataPerRW = Warga::join('keluarga', function ($join) use ($currentYear) {
                $join->on('warga.no_kk', '=', 'keluarga.no_kk')
                    ->where('warga.tahun_data', '=', $currentYear)
                    ->where('keluarga.tahun_data', '=', $currentYear);
            })
                ->selectRaw('keluarga.rw,
                SUM(CASE WHEN warga.jenis_kelamin = "Laki-laki" THEN 1 ELSE 0 END) as laki_laki,
                SUM(CASE WHEN warga.jenis_kelamin = "Perempuan" THEN 1 ELSE 0 END) as perempuan')
                ->groupBy('keluarga.rw')
                ->get();

            // Query untuk mendapatkan total laki-laki dan perempuan
            $totalLakiLaki = Warga::where('tahun_data', $currentYear)
                ->where('jenis_kelamin', 'Laki-laki')
                ->count();

            $totalPerempuan = Warga::where('tahun_data', $currentYear)
                ->where('jenis_kelamin', 'Perempuan')
                ->count();

            return response()->json([
                'dataPerRW' => $dataPerRW,
                'totalLakiLaki' => $totalLakiLaki,
                'totalPerempuan' => $totalPerempuan
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching gender data: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    // Fungsi untuk mengambil data status PKH
    public function grafik_pkh()
    {
        $currentYear = Carbon::now()->year;

        // Query untuk mendapatkan jumlah penerima dan non-penerima PKH per RW
        $dataPerRW = Keluarga::selectRaw('rw,
            SUM(CASE WHEN status_pkh = 1 THEN 1 ELSE 0 END) as pkh_recipients,
            SUM(CASE WHEN status_pkh = 0 THEN 1 ELSE 0 END) as non_pkh_recipients')
            ->where('tahun_data', $currentYear)
            ->groupBy('rw')
            ->get();

        // Query untuk mendapatkan jumlah total penerima PKH
        $totalPkhRecipients = Keluarga::where('tahun_data', $currentYear)
            ->where('status_pkh', 1)
            ->count();

        // Query untuk mendapatkan jumlah total non-penerima PKH
        $totalNonPkhRecipients = Keluarga::where('tahun_data', $currentYear)
            ->where('status_pkh', 0)
            ->count();

        // Menggabungkan hasil dalam satu respon JSON
        return response()->json([
            'dataPerRW' => $dataPerRW,
            'totalPkhRecipients' => $totalPkhRecipients,
            'totalNonPkhRecipients' => $totalNonPkhRecipients
        ]);
    }

    // Fungsi untuk mengambil data status kepemilikan KTP
    public function grafik_ktp()
    {
        $currentYear = Carbon::now()->year;

        // Query untuk mendapatkan jumlah warga dengan KTP dan tanpa KTP per RW
        $dataPerRW = Warga::join('keluarga', function ($join) use ($currentYear) {
            $join->on('warga.no_kk', '=', 'keluarga.no_kk')
                ->where('warga.tahun_data', '=', $currentYear)
                ->where('keluarga.tahun_data', '=', $currentYear);
        })
            ->selectRaw('keluarga.rw,
        SUM(CASE WHEN warga.punya_ktp = 1 THEN 1 ELSE 0 END) as with_ktp,
        SUM(CASE WHEN warga.punya_ktp = 0 THEN 1 ELSE 0 END) as without_ktp')
            ->groupBy('keluarga.rw')
            ->get();

        // Query untuk mendapatkan jumlah total warga dengan KTP
        $totalWithKtp = Warga::where('tahun_data', $currentYear)
            ->where('punya_ktp', 1)
            ->count();

        // Query untuk mendapatkan jumlah total warga tanpa KTP
        $totalWithoutKtp = Warga::where('tahun_data', $currentYear)
            ->where('punya_ktp', 0)
            ->count();

        // Menggabungkan hasil dalam satu respon JSON
        return response()->json([
            'dataPerRW' => $dataPerRW,
            'totalWithKtp' => $totalWithKtp,
            'totalWithoutKtp' => $totalWithoutKtp
        ]);
    }

    // Fungsi untuk mengambil data status kepemilikan akta lahir
    public function grafik_akta_lahir()
    {
        $currentYear = Carbon::now()->year;

        // Query untuk mendapatkan jumlah warga dengan dan tanpa akta kelahiran per RW
        $dataPerRW = Warga::join('keluarga', function ($join) use ($currentYear) {
            $join->on('warga.no_kk', '=', 'keluarga.no_kk')
                ->where('warga.tahun_data', '=', $currentYear)
                ->where('keluarga.tahun_data', '=', $currentYear);
        })
            ->selectRaw('keluarga.rw,
        SUM(CASE WHEN warga.no_akta_lahir IS NOT NULL THEN 1 ELSE 0 END) as with_certificate,
        SUM(CASE WHEN warga.no_akta_lahir IS NULL THEN 1 ELSE 0 END) as without_certificate')
            ->groupBy('keluarga.rw')
            ->get();

        // Query untuk mendapatkan jumlah total warga dengan akta kelahiran
        $totalWithCertificate = Warga::where('tahun_data', $currentYear)
            ->whereNotNull('no_akta_lahir')
            ->count();

        // Query untuk mendapatkan jumlah total warga tanpa akta kelahiran
        $totalWithoutCertificate = Warga::where('tahun_data', $currentYear)
            ->whereNull('no_akta_lahir')
            ->count();

        // Menggabungkan hasil dalam satu respon JSON
        return response()->json([
            'dataPerRW' => $dataPerRW,
            'totalWithCertificate' => $totalWithCertificate,
            'totalWithoutCertificate' => $totalWithoutCertificate
        ]);
    }

    // Fungsi untuk mengambil data status kepemilikan JKN
    public function grafik_jkn()
    {
        $currentYear = Carbon::now()->year;

        // Query untuk mendapatkan jumlah warga dengan berbagai status JKN per RW
        $dataPerRW = Warga::join('keluarga', function ($join) use ($currentYear) {
            $join->on('warga.no_kk', '=', 'keluarga.no_kk')
                ->where('warga.tahun_data', '=', $currentYear)
                ->where('keluarga.tahun_data', '=', $currentYear);
        })
            ->selectRaw('keluarga.rw,
        SUM(CASE WHEN warga.status_jkn = "JKN PBI" THEN 1 ELSE 0 END) as jkn_pbi,
        SUM(CASE WHEN warga.status_jkn = "JKN NON PBI" THEN 1 ELSE 0 END) as jkn_non_pbi,
        SUM(CASE WHEN warga.status_jkn = "NON JKN" THEN 1 ELSE 0 END) as non_jkn')
            ->groupBy('keluarga.rw')
            ->get();

        // Query untuk mendapatkan jumlah total warga dengan status JKN PBI
        $totalJknPbi = Warga::where('tahun_data', $currentYear)
            ->where('status_jkn', 'JKN PBI')
            ->count();

        // Query untuk mendapatkan jumlah total warga dengan status JKN NON PBI
        $totalJknNonPbi = Warga::where('tahun_data', $currentYear)
            ->where('status_jkn', 'JKN NON PBI')
            ->count();

        // Query untuk mendapatkan jumlah total warga dengan status NON JKN
        $totalNonJkn = Warga::where('tahun_data', $currentYear)
            ->where('status_jkn', 'NON JKN')
            ->count();

        // Menggabungkan hasil dalam satu respon JSON
        return response()->json([
            'dataPerRW' => $dataPerRW,
            'totalJknPbi' => $totalJknPbi,
            'totalJknNonPbi' => $totalJknNonPbi,
            'totalNonJkn' => $totalNonJkn
        ]);
    }

    // Fungsi untuk mengambil data umur (laki-laki)
    public function grafik_umur_laki()
    {
        $currentYear = Carbon::now()->year;

        // Query untuk mendapatkan jumlah warga dalam setiap kelompok umur per RW
        $dataPerRW = Warga::join('keluarga', function ($join) use ($currentYear) {
            $join->on('warga.no_kk', '=', 'keluarga.no_kk')
                ->where('warga.tahun_data', '=', $currentYear)
                ->where('keluarga.tahun_data', '=', $currentYear);
        })
            ->selectRaw('keluarga.rw,
            SUM(CASE WHEN warga.jenis_kelamin = "Laki-laki" AND TIMESTAMPDIFF(YEAR, warga.tanggal_lahir, CURDATE()) BETWEEN 0 AND 17 THEN 1 ELSE 0 END) as age_group_0_17,
            SUM(CASE WHEN warga.jenis_kelamin = "Laki-laki" AND TIMESTAMPDIFF(YEAR, warga.tanggal_lahir, CURDATE()) BETWEEN 18 AND 35 THEN 1 ELSE 0 END) as age_group_18_35,
            SUM(CASE WHEN warga.jenis_kelamin = "Laki-laki" AND TIMESTAMPDIFF(YEAR, warga.tanggal_lahir, CURDATE()) BETWEEN 36 AND 55 THEN 1 ELSE 0 END) as age_group_36_55,
            SUM(CASE WHEN warga.jenis_kelamin = "Laki-laki" AND TIMESTAMPDIFF(YEAR, warga.tanggal_lahir, CURDATE()) >= 56 THEN 1 ELSE 0 END) as age_group_56_above')
            ->groupBy('keluarga.rw')
            ->get();

        // Query untuk mendapatkan jumlah total warga dalam kelompok umur 0-17
        $totalAgeGroup_0_17 = Warga::where('tahun_data', $currentYear)
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 17')
            ->count();

        // Query untuk mendapatkan jumlah total warga dalam kelompok umur 18-35
        $totalAgeGroup_18_35 = Warga::where('tahun_data', $currentYear)
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 35')
            ->count();

        // Query untuk mendapatkan jumlah total warga dalam kelompok umur 36-55
        $totalAgeGroup_36_55 = Warga::where('tahun_data', $currentYear)
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 36 AND 55')
            ->count();

        // Query untuk mendapatkan jumlah total warga dalam kelompok umur 56 ke atas
        $totalAgeGroup_56_Above = Warga::where('tahun_data', $currentYear)
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 56')
            ->count();

        // Menggabungkan hasil dalam satu respon JSON
        return response()->json([
            'dataPerRW' => $dataPerRW,
            'totalAgeGroup_0_17' => $totalAgeGroup_0_17,
            'totalAgeGroup_18_35' => $totalAgeGroup_18_35,
            'totalAgeGroup_36_55' => $totalAgeGroup_36_55,
            'totalAgeGroup_56_Above' => $totalAgeGroup_56_Above
        ]);
    }

    public function grafik_umur_perempuan()
    {
        $currentYear = Carbon::now()->year;

        // Query untuk mendapatkan jumlah warga perempuan dalam setiap kelompok umur per RW
        $dataPerRW = Warga::join('keluarga', function ($join) use ($currentYear) {
            $join->on('warga.no_kk', '=', 'keluarga.no_kk')
                ->where('warga.tahun_data', '=', $currentYear)
                ->where('keluarga.tahun_data', '=', $currentYear);
        })
            ->selectRaw('keluarga.rw,
            SUM(CASE WHEN warga.jenis_kelamin = "Perempuan" AND TIMESTAMPDIFF(YEAR, warga.tanggal_lahir, CURDATE()) BETWEEN 0 AND 17 THEN 1 ELSE 0 END) as age_group_0_17,
            SUM(CASE WHEN warga.jenis_kelamin = "Perempuan" AND TIMESTAMPDIFF(YEAR, warga.tanggal_lahir, CURDATE()) BETWEEN 18 AND 35 THEN 1 ELSE 0 END) as age_group_18_35,
            SUM(CASE WHEN warga.jenis_kelamin = "Perempuan" AND TIMESTAMPDIFF(YEAR, warga.tanggal_lahir, CURDATE()) BETWEEN 36 AND 55 THEN 1 ELSE 0 END) as age_group_36_55,
            SUM(CASE WHEN warga.jenis_kelamin = "Perempuan" AND TIMESTAMPDIFF(YEAR, warga.tanggal_lahir, CURDATE()) >= 56 THEN 1 ELSE 0 END) as age_group_56_above')
            ->groupBy('keluarga.rw')
            ->get();

        // Query untuk mendapatkan jumlah total warga perempuan dalam kelompok umur 0-17
        $totalAgeGroup_0_17 = Warga::where('tahun_data', $currentYear)
            ->where('jenis_kelamin', 'Perempuan')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 17')
            ->count();

        // Query untuk mendapatkan jumlah total warga perempuan dalam kelompok umur 18-35
        $totalAgeGroup_18_35 = Warga::where('tahun_data', $currentYear)
            ->where('jenis_kelamin', 'Perempuan')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 35')
            ->count();

        // Query untuk mendapatkan jumlah total warga perempuan dalam kelompok umur 36-55
        $totalAgeGroup_36_55 = Warga::where('tahun_data', $currentYear)
            ->where('jenis_kelamin', 'Perempuan')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 36 AND 55')
            ->count();

        // Query untuk mendapatkan jumlah total warga perempuan dalam kelompok umur 56 ke atas
        $totalAgeGroup_56_Above = Warga::where('tahun_data', $currentYear)
            ->where('jenis_kelamin', 'Perempuan')
            ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 56')
            ->count();

        // Menggabungkan hasil dalam satu respon JSON
        return response()->json([
            'dataPerRW' => $dataPerRW,
            'totalAgeGroup_0_17' => $totalAgeGroup_0_17,
            'totalAgeGroup_18_35' => $totalAgeGroup_18_35,
            'totalAgeGroup_36_55' => $totalAgeGroup_36_55,
            'totalAgeGroup_56_Above' => $totalAgeGroup_56_Above
        ]);
    }
}
