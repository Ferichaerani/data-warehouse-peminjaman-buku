<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    // ✅ Tambahkan kategori ke dalam fillable
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'kategori', // ← ini penting agar kategori bisa disimpan
        'stok',
    ];

    // Relasi ke tabel pinjam
    public function pinjams()
    {
        return $this->hasMany(Pinjam::class);
    }

    // Accessor status otomatis berdasarkan stok peminjaman
    public function getStatusAttribute()
    {
        return $this->stok > 0 ? 'Tersedia' : 'Dipinjam';
    }
}
