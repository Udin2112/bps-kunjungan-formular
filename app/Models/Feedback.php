<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'alamat',
        'jenis_kelamin',
        'usia',
        'tanggal_kunjungan',
        'pekerjaan',
        'instansi',
        'layanan',
        'kunjungan',
        'message',
        'survei', // ✅ kolom survei skala 1-5
    ];
}
