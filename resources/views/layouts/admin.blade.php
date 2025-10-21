<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin CV Alam Borneo' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-700 dark:bg-gray-800 text-white shadow-lg min-h-screen flex flex-col justify-between">
            <div>
                <div class="text-2xl font-bold border-b border-blue-500 dark:border-gray-700 p-6">
                    <i class="fa-solid fa-leaf mr-2 text-green-400"></i> CV Alam Borneo
                </div>

               <nav class="p-4 flex flex-col space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-600 dark:hover:bg-gray-700 transition {{ request()->routeIs('dashboard') ? 'bg-blue-800 dark:bg-gray-700' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                </a>

                <!-- Produk -->
                <a href="{{ route('produk.index') }}" 
                class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-600 dark:hover:bg-gray-700 transition {{ request()->routeIs('produk.*') ? 'bg-blue-800 dark:bg-gray-700' : '' }}">
                    <i class="fa-solid fa-box"></i> Produk
                </a>

                <!-- Pelanggan -->
                <a href="{{ route('pelanggan.index') }}" 
                class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-600 dark:hover:bg-gray-700 transition {{ request()->routeIs('pelanggan.*') ? 'bg-blue-800 dark:bg-gray-700' : '' }}">
                    <i class="fa-solid fa-users"></i> Pelanggan
                </a>

                <!-- Transaksi -->
                <a href="{{ route('transaksi.index') }}" 
                class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-600 dark:hover:bg-gray-700 transition {{ request()->routeIs('transaksi.*') ? 'bg-blue-800 dark:bg-gray-700' : '' }}">
                    <i class="fa-solid fa-money-bill-wave"></i> Transaksi
                </a>

                <!-- Laporan -->
                <a href="{{ route('laporan.index') }}" 
                class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-600 dark:hover:bg-gray-700 transition {{ request()->routeIs('laporan.*') ? 'bg-blue-800 dark:bg-gray-700' : '' }}">
                    <i class="fa-solid fa-chart-line"></i> Laporan
                </a>
            </nav>

            </div>

            <!-- Profil User + Logout -->
            <div class="border-t border-blue-500 dark:border-gray-700 p-4 space-y-3">
                @auth
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-blue-600 dark:hover:bg-gray-700 transition">
                    @php
                        $user = Auth::user();
                        $initials = strtoupper(substr($user->name ?? 'U', 0, 2));
                    @endphp

                    {{-- Avatar bulat --}}
                    <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-lg font-semibold text-gray-700 dark:text-gray-100">
                        {{ $initials }}
                    </div>

                    {{-- Info user --}}
                    <div class="flex flex-col">
                        <span class="text-sm font-semibold">{{ $user->name ?? 'User' }}</span>
                        <span class="text-xs text-gray-300">{{ $user->email ?? '' }}</span>
                    </div>
                </a>
                @endauth

                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button type="submit"
                        class="w-full text-left flex items-center gap-2 px-4 py-2 rounded bg-red-500 hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800 transition">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <header class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex justify-between items-center transition-colors duration-300">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $title ?? 'Dashboard' }}</h1>

                <!-- Tombol Toggle Dark Mode -->
                <button id="themeToggle"
                    class="p-2 rounded-lg bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 transition">
                    <i id="themeIcon" class="fa-solid fa-moon text-gray-800 dark:text-yellow-400"></i>
                </button>
            </header>

            <main class="flex-1 p-6 overflow-auto">
                @yield('content')
            </main>

            <footer class="bg-white dark:bg-gray-800 border-t dark:border-gray-700 px-6 py-4 text-gray-600 dark:text-gray-400 text-sm">
                &copy; {{ date('Y') }} CV Alam Borneo. All rights reserved.
            </footer>
        </div>
    </div>

    <!-- Script Toggle -->
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const html = document.documentElement;

        if (localStorage.theme === 'dark' || 
           (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
            themeIcon.classList.replace('fa-moon', 'fa-sun');
        } else {
            html.classList.remove('dark');
        }

        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            localStorage.theme = isDark ? 'dark' : 'light';
            themeIcon.classList.toggle('fa-moon', !isDark);
            themeIcon.classList.toggle('fa-sun', isDark);
        });
    </script>
</body>
</html>
