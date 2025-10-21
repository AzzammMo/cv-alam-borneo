<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV. Alam Borneo - Sistem Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-yQOj1oP9l7b..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-white text-gray-800">

  <!-- Navbar -->
<nav class="bg-blue-600 shadow-md fixed w-full z-50 top-0">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="" class="text-xl font-bold text-white flex items-center">
            <i class="fa-solid fa-boxes mr-2"></i>CV. Alam Borneo
        </a>
        <div>
            <a href="{{ route('login') }}" class="bg-yellow-400 text-gray-800 font-semibold px-4 py-2 rounded hover:bg-yellow-300 flex items-center">
                <i class="fa-solid fa-sign-in-alt mr-1"></i>Login
            </a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="relative h-screen flex flex-col items-center justify-center text-center mt-16">
    <!-- Background Image -->
    <img src="image.png" alt="Inventaris" class="absolute inset-0 w-full h-full object-cover">
    <!-- Dark Overlay semi-transparan -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <!-- Konten Teks -->
    <div class="relative z-10 px-6 max-w-3xl">
        <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg">
            Sistem Manajemen Inventaris
        </h1>
        <p class="text-lg md:text-2xl text-white drop-shadow-md mt-4">
            Sederhana, Cepat, dan Terorganisir untuk Mengelola Stok & Transaksi
        </p>

        <!-- Mini Dashboard / Quick Links -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12">
            <a href="#" class="bg-blue-100 hover:bg-blue-200 rounded-lg p-4 shadow flex flex-col items-center">
                <i class="fa-solid fa-box-open text-3xl text-blue-600 mb-2"></i>
                <span class="font-semibold text-gray-700">Produk</span>
            </a>
            <a href="#" class="bg-blue-100 hover:bg-blue-200 rounded-lg p-4 shadow flex flex-col items-center">
                <i class="fa-solid fa-users text-3xl text-blue-600 mb-2"></i>
                <span class="font-semibold text-gray-700">Pelanggan</span>
            </a>
            <a href="#" class="bg-blue-100 hover:bg-blue-200 rounded-lg p-4 shadow flex flex-col items-center">
                <i class="fa-solid fa-chart-line text-3xl text-blue-600 mb-2"></i>
                <span class="font-semibold text-gray-700">Laporan</span>
            </a>
            <a href="#" class="bg-blue-100 hover:bg-blue-200 rounded-lg p-4 shadow flex flex-col items-center">
                <i class="fa-solid fa-warehouse text-3xl text-blue-600 mb-2"></i>
                <span class="font-semibold text-gray-700">Stok</span>
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 bg-blue-50">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-12 text-blue-600">
            <i class="fa-solid fa-star mr-2"></i>Fitur Utama
        </h2>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="text-blue-600 text-5xl mb-6">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-3">Manajemen Pelanggan & Penjualan</h3>
                <p class="text-gray-700 mb-3">
                    Kelola semua data pelanggan, histori transaksi, dan nota penjualan dalam satu dashboard yang mudah dipahami. 
                    Tingkatkan pengalaman pelanggan dengan pencatatan yang cepat dan rapi.
                </p>
                <span class="text-sm text-gray-500">Monitoring & Reporting Real-time</span>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="text-blue-600 text-5xl mb-6">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-3">CRUD Produk & Stok Barang</h3>
                <p class="text-gray-700 mb-3">
                    Tambah, edit, hapus, dan pantau stok barang dengan mudah. Setiap perubahan stok langsung terlihat, 
                    sehingga meminimalkan kesalahan inventaris.
                </p>
                <span class="text-sm text-gray-500">Update Stok Otomatis & Mudah Dilacak</span>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="text-blue-600 text-5xl mb-6">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-3">Dashboard Analitik</h3>
                <p class="text-gray-700 mb-3">
                    Visualisasi penjualan, stok, dan performa bisnis secara visual dan mudah dipahami. 
                    Membantu mengambil keputusan bisnis lebih cepat dan tepat.
                </p>
                <span class="text-sm text-gray-500">Insight & Analisa Bisnis</span>
            </div>
        </div>
    </div>
</section>

<!-- Analytics Section -->
<section id="analytics" class="bg-white py-20">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-12 text-blue-600">
            <i class="fa-solid fa-chart-line mr-2"></i>Dashboard Analitik
        </h2>
        <p class="mb-8 max-w-2xl mx-auto text-gray-700">
            Visualisasi penjualan, stok, dan histori transaksi dalam satu dashboard yang mudah dipahami.
        </p>
        <img src="https://via.placeholder.com/900x400?text=Dashboard+Analytics" alt="Dashboard Analytics" class="mx-auto rounded shadow-lg">
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-12 bg-blue-50">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-4 text-blue-600">
            <i class="fa-solid fa-envelope-open-text mr-2"></i>Hubungi Kami
        </h2>
        <p class="mb-2 text-gray-700"><i class="fa-solid fa-map-marker-alt mr-2 text-blue-600"></i>CV. Alam Borneo, Jl. Contoh Alamat No.123, Kota Sampel</p>
        <p class="mb-2 text-gray-700"><i class="fa-solid fa-envelope mr-2 text-blue-600"></i>Email: info@alamborneo.com | <i class="fa-solid fa-phone mr-2 text-blue-600"></i>Telp: 0812-3456-7890</p>
        <a href="mailto:info@alamborneo.com" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 flex items-center justify-center mx-auto w-fit">
            <i class="fa-solid fa-paper-plane mr-2"></i>Kirim Email
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-blue-600 py-6">
    <div class="container mx-auto px-6 text-center text-white">
        <i class="fa-solid fa-copyright mr-1"></i>{{ date('Y') }} CV. Alam Borneo. Semua Hak Dilindungi.
    </div>
</footer>

</body>
</html>
