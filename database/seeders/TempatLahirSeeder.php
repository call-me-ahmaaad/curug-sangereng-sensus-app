<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TempatLahirSeeder extends Seeder
{
    public function run()
    {
        // Path to your CSV file
        $csvFile = base_path('database/data/daftar-kabupaten-kota-di-indonesia.csv');

        // Read the CSV file
        $data = array_map('str_getcsv', file($csvFile));

        // Remove the header row if your CSV file has headers
        array_shift($data);

        // Insert data into tempat_lahir table
        foreach ($data as $row) {
            DB::table('tempat_lahir')->insert([
                'tempat_lahir' => $row[0], // Assuming the first column contains the tempat_lahir data
            ]);
        }
    }
}

