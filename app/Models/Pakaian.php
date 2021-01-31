<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakaian extends Model
{
    use HasFactory;

    protected $table = 'pakaian';
    protected $primaryKey = 'pakaian_id';
    protected $fillable = [
        'pakaian_transaksi',
        'pakaian_jenis',
        'pakaian_jumlah',
    ];

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'transaksi_id', 'pakaian_transaksi');
    }
}
