<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    protected $fillable = [
        'transaksi_tgl',
        'transaksi_pelanggan',
        'transaksi_harga',
        'transaksi_berat',
        'transaksi_tgl_selesai',
        'transaksi_status',
    ];

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'pelanggan_id', 'transaksi_pelanggan');
    }

    public function pakaian()
    {
        return $this->belongsTo(Pakaian::class);
    }
}
