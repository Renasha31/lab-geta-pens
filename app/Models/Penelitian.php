<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    protected $fillable = [
        'penulis_id',
        'judul',
        'isi',
        'tanggal',
        'peneliti',
        'image'
    ];

    public function penulis() {
        return $this->belongsTo(Penulis::class);
    }
}
