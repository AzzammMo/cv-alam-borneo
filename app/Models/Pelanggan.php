<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Nama tabel (opsional kalau nama tabel bukan jamak)
    protected $table = 'pelanggans';

    // Kolom yang boleh diisi massal (fillable)
    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'alamat',
        'email',
    ];

    // Relasi ke transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
