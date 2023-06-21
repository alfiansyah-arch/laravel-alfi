<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_transaksi' ,
        'kode_petugas' ,
        'price' ,
    ];
    public function getPetugas(){
        return $this->belongsTo(PetugasJumats::class, 'kode_petugas', 'id');
    }
}
