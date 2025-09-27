<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';

    // kolom yang bisa di set by user
    protected $fillable = [
        'kode',
        'nama',
        'kapasitas'
    ];
    
}
