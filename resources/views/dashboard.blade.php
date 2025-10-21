<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md h-screen p-6">
            <div class="text-xl font-bold border-b pb-2 mb-4">CV Alam Borneo</div>
            <nav class="flex flex-col space-y-2">
                <a href="{{ route('produk.create') }}" class="px-4 py-2 hover:bg-gray-100 rounded">Tambah Produk</a>
                <!-- Bisa ditambahkan link lain di sini nanti -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mt-4 px-4 py-2 text-left hover:bg-red-100 rounded text-red-600">Logout</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-100 min-h-screen">
            <p class="text-gray-500">Selamat datang di dashboard. Gunakan sidebar untuk mengakses fitur.</p>
        </main>
    </div>
</x-app-layout>
