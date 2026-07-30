<?php

namespace App\Models; 
 
use Illuminate\Database\Eloquent\Model; 
 
class Mahasiswa extends Model 
{ 
    protected $fillable = ['nim', 'nama', 'email', 'no_telp']; 
 
    public function pinjams() 
    { 
        return $this->hasMany(Pinjam::class); 
    } 
}