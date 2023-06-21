<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_transaksi',
        'tgl_transaksi',
        'id_pemesan',
        'nama_masjid',
        'alamat',
        'total'
    ];

    public function detail()
    {
        return $this->hasMany(TransaksiDetails::class, 'no_transaksi', 'no_transaksi');
    }

    public function getManager()
    {
        return $this->belongsTo(User::class, 'id_pemesan', 'id');
    }
}
