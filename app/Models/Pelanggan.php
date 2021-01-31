<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';
    protected $fillable = [
        'pelanggan_nama',
        'pelanggan_hp',
        'pelanggan_alamat',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
