<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';

    protected $fillable = [
            'kode',
            'nama',
            'sks'
    ];
}
