@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <form action="{{ route('produk.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Nama Produk</label>
            <input type="text" name="nama_produk" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Stok</label>
            <input type="number" name="stok" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Harga</label>
            <input type="number" name="harga" class="w-full border px-3 py-2 rounded" required>
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow transition">Simpan</button>
        <a href="{{ route('produk.index') }}" class="bg-gray-300 px-4 py-2 rounded ml-2">Batal</a>
    </form>
</div>
@endsection
