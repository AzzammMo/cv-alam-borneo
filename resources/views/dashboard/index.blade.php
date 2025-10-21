@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
@php
    date_default_timezone_set('Asia/Makassar'); // sesuaikan timezone Indonesia timur
    $hour = (int) now()->format('H');
    $minute = (int) now()->format('i');
    $time = $hour + $minute / 60;

    if ($time >= 5 && $time < 11) {
        $greeting = 'Selamat Pagi';
        $icon = 'fa-sun';
    } elseif ($time >= 11 && $time < 14.5) {
        $greeting = 'Selamat Siang';
        $icon = 'fa-sun';
    } elseif ($time >= 14.5 && $time < 17) {
        $greeting = 'Selamat Sore';
        $icon = 'fa-cloud-sun';
    } else {
        $greeting = 'Selamat Malam';
        $icon = 'fa-moon';
    }
@endphp

<div class="p-6 space-y-6">
    <!-- Greeting Banner -->
    <div class="bg-gradient-to-r from-blue-400 to-blue-600 dark:from-gray-800 dark:to-gray-900 p-6 rounded-lg shadow flex justify-between items-center text-white">
        <div class="flex items-center gap-4">
            <i class="fa-solid {{ $icon }} text-4xl"></i>
            <div>
                <h1 class="text-2xl font-bold">{{ $greeting }}, {{ Auth::user()->name ?? 'User' }}!</h1>
                <p class="text-sm opacity-80" id="currentTime">Waktu: {{ now()->format('d M Y H:i:s') }}</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
        <!-- Total Produk -->
        <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded shadow flex items-center gap-4">
            <i class="fa-solid fa-box text-3xl text-blue-700 dark:text-blue-300"></i>
            <div>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Total Produk</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-200 mt-1">{{ \App\Models\Produk::count() }}</p>
            </div>
        </div>

        <!-- Total Pelanggan -->
        <div class="bg-green-100 dark:bg-green-800 p-4 rounded shadow flex items-center gap-4">
            <i class="fa-solid fa-users text-3xl text-green-700 dark:text-green-300"></i>
            <div>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Total Pelanggan</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-200 mt-1">{{ \App\Models\Pelanggan::count() }}</p>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="bg-yellow-100 dark:bg-yellow-800 p-4 rounded shadow flex items-center gap-4">
            <i class="fa-solid fa-money-bill-wave text-3xl text-yellow-700 dark:text-yellow-300"></i>
            <div>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Total Transaksi</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-200 mt-1">{{ \App\Models\Transaksi::count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Update time real-time dengan JS -->
<script>
    function updateTime() {
        const now = new Date();
        const options = { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
        document.getElementById('currentTime').textContent = 'Waktu: ' + now.toLocaleString('id-ID', options);
    }
    setInterval(updateTime, 1000);
</script>

<!-- SweetAlert2 -->
@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Berhasil Login!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#2563eb',
            background: '#f0f9ff',
            timer: 2500,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    </script>
@endif
@endsection
