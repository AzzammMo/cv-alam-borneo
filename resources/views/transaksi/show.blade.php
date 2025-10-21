@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-700 flex items-center gap-2">
            <i class="fa-solid fa-receipt text-blue-600"></i>
            Detail Transaksi
        </h1>
        <a href="{{ route('transaksi.index') }}"
           class="flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition duration-200">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Informasi Umum Transaksi -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="flex items-center gap-3 bg-blue-50 border border-blue-200 p-4 rounded-lg">
            <i class="fa-solid fa-calendar-days text-blue-600 text-xl"></i>
            <div>
                <p class="text-sm text-gray-500 font-medium">Tanggal Transaksi</p>
                <p class="font-semibold text-gray-800">{{ $transaksi->tanggal_transaksi }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3 bg-green-50 border border-green-200 p-4 rounded-lg">
            <i class="fa-solid fa-user text-green-600 text-xl"></i>
            <div>
                <p class="text-sm text-gray-500 font-medium">Pelanggan</p>
                <p class="font-semibold text-gray-800">{{ $transaksi->pelanggan->nama_lengkap }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3 bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
            <i class="fa-solid fa-sack-dollar text-yellow-600 text-xl"></i>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Harga</p>
                <p class="font-semibold text-gray-800">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Rincian Produk -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2 text-gray-700">
            <i class="fa-solid fa-box-open text-blue-600"></i>
            Rincian Produk
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-blue-600 text-white text-left">
                        <th class="px-4 py-3 font-semibold border border-blue-500">
                            <i class="fa-solid fa-box mr-1"></i> Produk
                        </th>
                        <th class="px-4 py-3 font-semibold border border-blue-500 text-center">
                            <i class="fa-solid fa-layer-group mr-1"></i> Kuantitas
                        </th>
                        <th class="px-4 py-3 font-semibold border border-blue-500 text-center">
                            <i class="fa-solid fa-money-bill-wave mr-1"></i> Harga Satuan
                        </th>
                        <th class="px-4 py-3 font-semibold border border-blue-500 text-center">
                            <i class="fa-solid fa-sack-dollar mr-1"></i> Subtotal
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($transaksi->detail as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 border border-gray-200 font-medium text-gray-700">
                            {{ $item->produk->nama_produk }}
                        </td>
                        <td class="px-4 py-3 border border-gray-200 text-center font-medium text-gray-700">
                            {{ $item->kuantitas }}
                        </td>
                        <td class="px-4 py-3 border border-gray-200 text-center font-medium text-gray-700">
                            Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 border border-gray-200 text-center font-semibold text-gray-800">
                            Rp {{ number_format($item->harga_satuan * $item->kuantitas, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500 flex justify-center items-center gap-2">
                            <i class="fa-regular fa-folder-open text-gray-400 text-xl"></i>
                            Belum ada rincian produk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
