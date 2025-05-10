<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';

    protected $fillable = [
        'nama_tamu',
        'instansi',
        'nomor_telepon',
        'email',
        'tujuan_kunjungan',
        'bertemu_dengan',
        'foto_tamu',
        'waktu_masuk',
        'waktu_keluar',
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
    ];
}
