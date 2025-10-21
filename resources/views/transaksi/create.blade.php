@extends('layouts.admin')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Pelanggan</label>
            <select name="pelanggan_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($pelanggans as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <div id="produk-wrapper">
            <div class="produk-item mb-4 border-b pb-4">
                <label class="block mb-1">Produk</label>
                <select name="produk_id[]" class="w-full border px-3 py-2 rounded mb-2" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $pr)
                        <option value="{{ $pr->id }}">{{ $pr->nama_produk }} (Stok: {{ $pr->stok }})</option>
                    @endforeach
                </select>

                <label class="block mb-1">Kuantitas</label>
                <input type="number" name="kuantitas[]" class="w-full border px-3 py-2 rounded" min="1" required>
            </div>
        </div>

        <button type="button" id="add-produk" class="bg-blue-500 text-white px-3 py-2 rounded mb-4">+ Tambah Produk</button>
        <br>
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow transition">Simpan</button>
        <a href="{{ route('transaksi.index') }}" class="bg-gray-300 px-4 py-2 rounded ml-2">Batal</a>
    </form>
</div>

<script>
    document.getElementById('add-produk').addEventListener('click', () => {
        const wrapper = document.getElementById('produk-wrapper');
        const clone = wrapper.firstElementChild.cloneNode(true);
        wrapper.appendChild(clone);
    });
</script>
@endsection
