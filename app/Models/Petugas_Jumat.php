<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas_Jumat extends Model
{
    use HasFactory;
    protected $table = 'petugas_jumats';
    protected $fillable = [
        'nama_petugas',
        'tugas',
        'price',
    ];
}
