<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petugas_jumats extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_petugas',
        'nama_petugas',
        'tgl_lahir',
        'alamat',
        'no_telepon',
        'tugas',
        'tgl_bertugas',
        'nama_masjid'
    ];
    public static function generateCode()
    {
        $lastCode = self::orderBy('id', 'desc')->first();
        $lastNumber = $lastCode ? (int)substr($lastCode->kode_petugas, 4) : 0;
        $newNumber = $lastNumber + 1;
        $newCode = 'PTG-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        return $newCode;
    }
}
