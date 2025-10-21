<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Alam Borneo - Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="min-h-screen bg-gradient-to-b from-blue-200 to-blue-400 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center transition-colors duration-300">

    <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded-xl shadow-lg transition-colors duration-300">
        
        <!-- Judul -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-800 dark:text-blue-400">CV Alam Borneo</h1>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Silakan masuk ke akun Anda</p>
        </div>

        <!-- Session Status -->
        @if(session('status'))
            <div class="mb-4 text-green-600 dark:text-green-400 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div class="relative">
                <label for="email" class="block text-gray-700 dark:text-gray-200 font-medium">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full pl-10 pr-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
                <i class="fa-solid fa-envelope absolute left-3 top-9 text-gray-400 dark:text-gray-300"></i>
                @error('email')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="block text-gray-700 dark:text-gray-200 font-medium">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="mt-1 block w-full pl-10 pr-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-400 focus:outline-none transition" />
                <i class="fa-solid fa-lock absolute left-3 top-9 text-gray-400 dark:text-gray-300"></i>
                @error('password')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center text-gray-700 dark:text-gray-200">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="ml-2 text-sm">Remember me</span>
                </label>

                @if(Route::has('password.request'))
                    <a class="text-sm text-blue-700 dark:text-blue-400 hover:underline flex items-center gap-1" href="{{ route('password.request') }}">
                        <i class="fa-solid fa-key"></i> Forgot your password?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-semibold py-2 rounded-md transition flex justify-center items-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i> Log in
                </button>
            </div>
        </form>
    </div>
</body>
</html>
