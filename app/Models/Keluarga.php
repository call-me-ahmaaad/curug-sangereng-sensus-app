<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $table = 'keluarga';

    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'status_pkh',
        'rt',
        'rw',
        'tahun_data',
    ];

    // Define the composite primary key
    protected $primaryKey = ['no_kk', 'tahun_data'];
    public $incrementing = false;

    public function warga()
    {
        return $this->hasMany(Warga::class, 'no_kk', 'no_kk');
    }
}
