@extends('layouts.admin')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Alamat</label>
            <textarea name="alamat" class="w-full border px-3 py-2 rounded" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded">
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow transition">Simpan</button>
        <a href="{{ route('pelanggan.index') }}" class="bg-gray-300 px-4 py-2 rounded ml-2">Batal</a>
    </form>
</div>
@endsection
