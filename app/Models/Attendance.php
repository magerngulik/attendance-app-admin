<?php

namespace App;

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'waktu_masuk',
        'waktu_keluar',
        'lokasi_masuk',
        'lokasi_keluar',
        'tanggal',
        'device',
        "evidence"
    ];
}
