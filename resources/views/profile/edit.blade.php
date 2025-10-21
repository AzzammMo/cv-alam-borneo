@extends('layouts.admin')

@section('title', 'Profil Pengguna')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-user-gear text-blue-600 dark:text-blue-400"></i>
            Informasi Profil
        </h2>
        <div class="border-t border-gray-200 dark:border-gray-700 my-3"></div>
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-key text-yellow-500"></i>
            Ganti Password
        </h2>
        <div class="border-t border-gray-200 dark:border-gray-700 my-3"></div>
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-user-slash text-red-500"></i>
            Hapus Akun
        </h2>
        <div class="border-t border-gray-200 dark:border-gray-700 my-3"></div>
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
