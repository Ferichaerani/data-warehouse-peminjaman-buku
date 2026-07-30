<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Kembali extends Model
{
 protected $fillable = ['pinjam_id', 'tanggal_pengembalian', 'denda'];
 public function pinjam()
 {
 return $this->belongsTo(Pinjam::class);
 }
}