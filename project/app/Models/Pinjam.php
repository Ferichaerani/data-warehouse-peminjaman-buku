<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    // Kolom yang bisa diisi
    protected $fillable = [
        'mahasiswa_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    // Relasi ke Mahasiswa (many-to-one)
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // Relasi ke Buku (many-to-one)
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // Relasi ke Kembali (one-to-one)
    public function kembali()
    {
        return $this->hasOne(Kembali::class);
    }
}
