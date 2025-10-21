<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('pelanggan')->latest()->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
        return view('transaksi.create', compact('pelanggans', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'produk_id' => 'required|array',
            'kuantitas' => 'required|array',
        ]);

        $total = 0;

        // Buat transaksi utama
        $transaksi = Transaksi::create([
            'tanggal_transaksi' => now(),
            'pelanggan_id' => $request->pelanggan_id,
            'total_harga' => 0,
        ]);

        // Simpan detail transaksi
        foreach ($request->produk_id as $index => $produk_id) {
            $produk = Produk::findOrFail($produk_id);
            $qty = $request->kuantitas[$index];
            $harga_satuan = $produk->harga;

            DetailTransaksi::create([
                'produk_id' => $produk_id,
                'transaksi_id' => $transaksi->id,
                'kuantitas' => $qty,
                'harga_satuan' => $harga_satuan,
            ]);

            // kurangi stok produk
            $produk->decrement('stok', $qty);

            $total += $harga_satuan * $qty;
        }

        $transaksi->update(['total_harga' => $total]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('detail.produk', 'pelanggan');
        return view('transaksi.show', compact('transaksi'));
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
