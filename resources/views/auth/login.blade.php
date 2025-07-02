<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Media Cendekia Muslim</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-teal-100 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden w-full max-w-5xl grid grid-cols-1 md:grid-cols-2">
        <!-- Ilustrasi Kiri -->
        <div class="bg-blue-100 flex flex-col items-center justify-center p-10">
            <img src="{{ asset('images/login-illustration.jpg') }}" alt="Login Illustration" class="w-64 h-auto mb-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 text-center leading-snug">Selamat Datang di <br><span class="text-blue-600">Media Cendekia Muslim</span></h1>
            <p class="text-sm text-gray-600 mt-3 text-center">Silakan masuk untuk mengakses layanan kami.</p>
        </div>

        <!-- Form Login Kanan -->
        <div class="p-8 md:p-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Masuk ke Akun Anda</h2>

            {{-- Pesan Error --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16 12H8m0 0l4-4m-4 4l4 4"/>
                            </svg>
                        </span>
                        <input type="email" name="email" id="email" required
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('email') border-red-500 @enderror"
                               value="{{ old('email') }}">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 11c1.656 0 3-1.343 3-3s-1.344-3-3-3-3 1.343-3 3 1.344 3 3 3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 11v10"/>
                            </svg>
                        </span>
                        <input type="password" name="password" id="password" required
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('password') border-red-500 @enderror">
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa Kata Sandi?</a>

                </div>

                <button type="submit"
                        class="w-full bg-blue-500 text-white py-3 rounded-md font-medium hover:bg-blue-600 transition duration-200 shadow-md">
                    Masuk
                </button>

                <div class="my-4 text-center text-gray-400 flex items-center justify-center">
                    <hr class="flex-grow border-gray-300">
                    <span class="mx-3 text-sm">atau</span>
                    <hr class="flex-grow border-gray-300">
                </div>

                <p class="text-sm text-center text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Daftar</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
