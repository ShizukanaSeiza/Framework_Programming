<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
   use HasFactory; 
   
   // Nama tabel(opsional, default = "mahasiswa"->jamak)
        protected $table = 'matkul';

    // Kolom yang bisa diisi mass-assignment
        protected $fillable = [
            'nama',
            'keterangan',
        ]; 
}

