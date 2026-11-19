<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
        'nama_anggota',
        'jenis_anggota',
        'ttl',
        'rpdk',
        'image'
    ];
}
