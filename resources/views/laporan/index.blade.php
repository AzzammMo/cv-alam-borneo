@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-100 flex items-center gap-2">
        <i class="fa-solid fa-chart-line text-blue-600 dark:text-blue-400"></i>
        Laporan Penjualan
    </h1>
</div>

<!-- Filter Periode + Export Dropdown -->
<form method="GET" action="{{ route('laporan.index') }}" 
      class="bg-white dark:bg-gray-800 dark:text-gray-100 shadow-md rounded-lg p-4 flex flex-wrap md:flex-nowrap items-end gap-4 mb-6 border border-gray-200 dark:border-gray-700 transition-colors duration-300">
    
    <!-- Filter Bulan -->
    <div class="w-full md:w-1/4">
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1 flex items-center gap-1">
            <i class="fa-solid fa-calendar-days text-blue-500 dark:text-blue-400"></i> Bulan
        </label>
        <select name="bulan" 
                class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 
                       rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none 
                       text-gray-800 dark:text-gray-100">
            @for($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                </option>
            @endfor
        </select>
    </div>

    <!-- Filter Tahun -->
    <div class="w-full md:w-1/4">
        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1 flex items-center gap-1">
            <i class="fa-solid fa-calendar text-blue-500 dark:text-blue-400"></i> Tahun
        </label>
        <select name="tahun" 
                class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 
                       rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none 
                       text-gray-800 dark:text-gray-100">
            @for($t = now()->year; $t >= now()->year - 5; $t--)
                <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
            @endfor
        </select>
    </div>

    <!-- Tombol Filter & Export -->
    <div class="flex items-center gap-3 w-full md:w-auto relative">
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 
                   text-white font-semibold px-5 py-2.5 rounded-lg shadow flex items-center gap-2 transition duration-150">
            <i class="fa-solid fa-magnifying-glass"></i> Tampilkan
        </button>

        <!-- Dropdown Export PDF -->
        <div class="relative">
            <button id="exportDropdownButton"
                type="button"
                class="bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 
                       text-white font-semibold px-5 py-2.5 rounded-lg shadow flex items-center gap-2 transition duration-150">
                <i class="fa-solid fa-file-pdf"></i> Export PDF
                <i class="fa-solid fa-caret-down"></i>
            </button>

            <!-- Dropdown menu -->
            <div id="exportDropdownMenu"
                class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50">
                <a href="{{ route('laporan.export', ['periode' => 'mingguan']) }}"
                   class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-calendar-week text-blue-500"></i> Mingguan
                </a>
                <a href="{{ route('laporan.export', ['periode' => 'bulanan']) }}"
                   class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-calendar-days text-orange-500"></i> Bulanan
                </a>
                <a href="{{ route('laporan.export', ['periode' => 'tahunan']) }}"
                   class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-calendar text-purple-500"></i> Tahunan
                </a>
            </div>
        </div>
    </div>
</form>

<!-- Statistik -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-green-500 dark:bg-green-600 text-white p-5 rounded-lg shadow flex flex-col items-start gap-2 transition">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-sack-dollar text-2xl"></i>
            <h2 class="text-lg font-semibold">Total Penjualan</h2>
        </div>
        <p class="text-2xl font-bold">Rp {{ number_format($total_penjualan, 0, ',', '.') }}</p>
    </div>
    <div class="bg-blue-500 dark:bg-blue-600 text-white p-5 rounded-lg shadow flex flex-col items-start gap-2">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-boxes-stacked text-2xl"></i>
            <h2 class="text-lg font-semibold">Barang Terjual</h2>
        </div>
        <p class="text-2xl font-bold">{{ $barang_terjual }}</p>
    </div>
    <div class="bg-yellow-500 dark:bg-yellow-600 text-white p-5 rounded-lg shadow flex flex-col items-start gap-2">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-receipt text-2xl"></i>
            <h2 class="text-lg font-semibold">Transaksi</h2>
        </div>
        <p class="text-2xl font-bold">{{ $total_transaksi }}</p>
    </div>
    <div class="bg-purple-500 dark:bg-purple-600 text-white p-5 rounded-lg shadow flex flex-col items-start gap-2">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-users text-2xl"></i>
            <h2 class="text-lg font-semibold">Pelanggan Aktif</h2>
        </div>
        <p class="text-2xl font-bold">{{ $pelanggan_aktif }}</p>
    </div>
</div>

<!-- Tabel Detail Transaksi -->
<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 overflow-x-auto border border-gray-200 dark:border-gray-700 transition-colors duration-300">
    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2 text-gray-700 dark:text-gray-100">
        <i class="fa-solid fa-list text-blue-600 dark:text-blue-400"></i>
        Rincian Transaksi Bulan Ini
    </h3>

    <table class="w-full table-auto border border-gray-300 dark:border-gray-700 rounded-lg text-sm">
        <thead>
            <tr class="bg-blue-600 dark:bg-blue-700 text-white">
                <th class="px-4 py-3 font-semibold border border-blue-500 dark:border-blue-600 w-1/3 text-center">
                    <i class="fa-solid fa-calendar-day mr-1"></i> Tanggal
                </th>
                <th class="px-4 py-3 font-semibold border border-blue-500 dark:border-blue-600 w-1/3 text-center">
                    <i class="fa-solid fa-user mr-1"></i> Pelanggan
                </th>
                <th class="px-4 py-3 font-semibold border border-blue-500 dark:border-blue-600 w-1/3 text-center">
                    <i class="fa-solid fa-money-bill-wave mr-1"></i> Total Harga
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-center">
            @forelse($transaksis as $trx)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition text-gray-700 dark:text-gray-200 font-medium">
                <td class="px-4 py-3 border border-gray-200 dark:border-gray-700">
                    <i class="fa-regular fa-calendar-days text-blue-500 dark:text-blue-400 mr-1"></i> 
                    {{ $trx->tanggal_transaksi }}
                </td>
                <td class="px-4 py-3 border border-gray-200 dark:border-gray-700">
                    <i class="fa-solid fa-user-tag text-blue-500 dark:text-blue-400 mr-1"></i> 
                    {{ $trx->pelanggan->nama_lengkap }}
                </td>
                <td class="px-4 py-3 border border-gray-200 dark:border-gray-700">
                    <i class="fa-solid fa-money-bill text-green-500 dark:text-green-400 mr-1"></i>
                    Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center py-10 text-gray-500 dark:text-gray-400 font-medium">
                    <div class="flex justify-center items-center gap-2">
                        <i class="fa-regular fa-folder-open text-gray-400 dark:text-gray-500 text-xl"></i>
                        <span>Belum ada transaksi pada periode ini.</span>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Script Dropdown -->
<script>
    const exportBtn = document.getElementById('exportDropdownButton');
    const exportMenu = document.getElementById('exportDropdownMenu');

    exportBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        exportMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
        if (!exportMenu.contains(e.target) && !exportBtn.contains(e.target)) {
            exportMenu.classList.add('hidden');
        }
    });
</script>

@endsection
