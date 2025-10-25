<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController; 
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth'])->name('dashboard');


// CRUD Produk
Route::middleware(['auth'])->group(function () {
    Route::resource('produk', ProdukController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'exportPDF'])->name('laporan.export');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
