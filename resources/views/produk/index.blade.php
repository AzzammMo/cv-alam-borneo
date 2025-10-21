@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-100 flex items-center gap-2">
        <i class="fa-solid fa-boxes-stacked text-blue-600 dark:text-blue-400"></i>
        Daftar Produk
    </h1>
    <a href="{{ route('produk.create') }}"
       class="bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 
              text-white font-semibold px-4 py-2 rounded-lg shadow transition duration-200 flex items-center gap-2">
       <i class="fa-solid fa-circle-plus"></i> Tambah Produk
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 
                p-3 mb-4 rounded-lg shadow-sm flex items-center gap-2">
        <i class="fa-solid fa-circle-check text-green-600 dark:text-green-400"></i>
        {{ session('success') }}
    </div>
@endif

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 overflow-x-auto w-full 
            text-gray-800 dark:text-gray-100 transition-colors duration-300">
    <table class="w-full table-auto border border-gray-300 dark:border-gray-600 rounded-lg text-sm">
        <thead>
            <tr class="bg-blue-600 dark:bg-blue-700 text-white text-left">
                <th class="px-4 py-3 font-semibold border border-blue-500 dark:border-blue-600 w-1/3">
                    <i class="fa-solid fa-box mr-1"></i> Nama Produk
                </th>
                <th class="px-4 py-3 font-semibold border border-blue-500 dark:border-blue-600 w-1/6 text-center">
                    <i class="fa-solid fa-layer-group mr-1"></i> Stok
                </th>
                <th class="px-4 py-3 font-semibold border border-blue-500 dark:border-blue-600 w-1/4 text-center">
                    <i class="fa-solid fa-money-bill-wave mr-1"></i> Harga
                </th>
                <th class="px-4 py-3 font-semibold border border-blue-500 dark:border-blue-600 w-1/4 text-center">
                    <i class="fa-solid fa-gear mr-1"></i> Aksi
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($produks as $produk)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition text-gray-700 dark:text-gray-200 font-medium">
                <td class="px-4 py-3 border border-gray-200 dark:border-gray-700 align-middle">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-cube text-blue-500 dark:text-blue-400"></i>
                        {{ $produk->nama_produk }}
                    </div>
                </td>
                <td class="px-4 py-3 border border-gray-200 dark:border-gray-700 text-center align-middle">
                    {{ $produk->stok }}
                </td>
                <td class="px-4 py-3 border border-gray-200 dark:border-gray-700 text-center align-middle">
                    Rp {{ number_format($produk->harga, 2, ',', '.') }}
                </td>
                <td class="px-4 py-3 border border-gray-200 dark:border-gray-700 text-center align-middle">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('produk.edit', $produk->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 dark:bg-yellow-500 dark:hover:bg-yellow-600 
                                  text-white px-3 py-1.5 rounded-md shadow-sm transition duration-150 flex items-center gap-1 font-medium">
                           <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 
                                       text-white px-3 py-1.5 rounded-md shadow-sm transition duration-150 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-10 text-gray-500 dark:text-gray-400 font-medium">
                    <div class="flex justify-center items-center gap-2">
                        <i class="fa-regular fa-folder-open text-gray-400 dark:text-gray-500 text-xl"></i>
                        <span>Belum ada produk yang terdaftar.</span>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
