<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';

    protected $fillable = [
        'nik',
        'no_akta_lahir',
        'no_kk',
        'nama',
        'punya_ktp',
        'status_jkn',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'golongan_darah',
        'pendidikan',
        'pekerjaan',
        'status_nikah',
        'status_keluarga',
        'kewarganegaraan',
        'nama_ibu',
        'tahun_data',
    ];

    // Define the composite primary key
    protected $primaryKey = ['nik', 'tahun_data'];
    public $incrementing = false;

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'no_kk', 'no_kk');
    }

    public function tempatLahir()
    {
        return $this->belongsTo(TempatLahir::class, 'id_tempat_lahir', 'id'); // assuming `id` is the primary key in tempat_lahir table
    }
}
