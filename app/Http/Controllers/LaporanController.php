<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        // Filter transaksi berdasarkan bulan & tahun
        $transaksis = Transaksi::with('pelanggan')
            ->whereMonth('tanggal_transaksi', $bulan)
            ->whereYear('tanggal_transaksi', $tahun)
            ->get();

        // Hitung total penjualan & total barang
        $total_penjualan = $transaksis->sum('total_harga');
        $barang_terjual = DetailTransaksi::whereHas('transaksi', function ($q) use ($bulan, $tahun) {
                $q->whereMonth('tanggal_transaksi', $bulan)
                  ->whereYear('tanggal_transaksi', $tahun);
            })
            ->sum('kuantitas');

        $total_transaksi = $transaksis->count();
        $pelanggan_aktif = $transaksis->pluck('pelanggan_id')->unique()->count();

        return view('laporan.index', compact(
            'bulan',
            'tahun',
            'transaksis',
            'total_penjualan',
            'barang_terjual',
            'total_transaksi',
            'pelanggan_aktif'
        ));
    }

        public function exportPDF(Request $request)
    {
        $periode = $request->query('periode'); // 'mingguan','bulanan','tahunan' atau null
        $query = Transaksi::with('pelanggan');

        // Jika user juga memilih filter bulan/tahun, gunakan itu. Jika tidak dan periode null -> semua
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $bulan = (int) $request->bulan;
            $tahun = (int) $request->tahun;
            $query->whereMonth('tanggal_transaksi', $bulan)
                ->whereYear('tanggal_transaksi', $tahun);
            $start = Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
            $end = Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();
        } else {
            // periode spesifik jika diberikan lewat dropdown periode
            if ($periode === 'mingguan') {
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                $query->whereBetween('tanggal_transaksi', [$start, $end]);
            } elseif ($periode === 'bulanan') {
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                $query->whereBetween('tanggal_transaksi', [$start, $end]);
            } elseif ($periode === 'tahunan') {
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->endOfYear();
                $query->whereBetween('tanggal_transaksi', [$start, $end]);
            } else {
                $start = null;
                $end = null;
                // no filter -> semua transaksi
            }
        }

        $transaksis = $query->orderBy('tanggal_transaksi','desc')->get();

        // Hitung statistik
        $total_penjualan = $transaksis->sum('total_harga');
        // contoh: hitung total barang terjual dari relation detail_transaksi (sesuaikan nama relation)
        $barang_terjual = $transaksis->sum(function($t){
            return $t->detail->sum('kuantitas') ?? 0;
        });
        $total_transaksi = $transaksis->count();
        $pelanggan_aktif = $transaksis->pluck('pelanggan_id')->unique()->count();

        $data = [
            'title' => 'Laporan Penjualan ' . ($periode ? ucfirst($periode) : 'Semua'),
            'start' => $start,
            'end' => $end,
            'transaksis' => $transaksis,
            'total_penjualan' => $total_penjualan,
            'barang_terjual' => $barang_terjual,
            'total_transaksi' => $total_transaksi,
            'pelanggan_aktif' => $pelanggan_aktif,
            'printed_at' => Carbon::now()->format('d M Y H:i:s'),
            'notes' => $request->get('notes', null),
        ];

        $pdf = Pdf::loadView('laporan.export', $data)->setPaper('a4', 'portrait');

        $filename = 'laporan_' . ($periode ?? 'semua') . '_' . now()->format('Ymd_His') . '.pdf';
        return $pdf->download($filename);
    }
}
