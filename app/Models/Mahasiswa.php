<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // pointing table
    protected $table = 'mahasiswa';

    // kolom yang bisa di set by user
    protected $fillable = [
        'nama',
        'nim',
        'kelas_id'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
