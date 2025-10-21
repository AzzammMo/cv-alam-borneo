<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_transaksi',
        'pelanggan_id',
        'total_harga',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
