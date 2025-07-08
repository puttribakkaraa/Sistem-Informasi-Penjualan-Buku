<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 via-white to-teal-50 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-6xl grid grid-cols-1 md:grid-cols-2">
        <!-- Left: Illustration -->
        <div class="bg-white p-10 flex flex-col items-center justify-center">
            <img src="{{ asset('images/login-illustration.jpg') }}" alt="Ilustrasi Register" class="w-80 mb-6">
            <h1 class="text-xl font-bold text-gray-800">Selamat Bergabung di <span class="text-blue-600">Website Kami</span></h1>
            <p class="text-sm text-gray-500 mt-2 text-center">Silakan daftar untuk membuat akun baru dan nikmati semua fitur kami.</p>

            <div class="mt-10 text-sm text-gray-400 text-center">
                <p>&copy; 2025 Media Cendekia Muslim. All Rights Reserved.</p>
            </div>
        </div>

        <!-- Right: Form -->
        <div class="p-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Akun Baru</h2>
           

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi Error Umum --}}
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full mt-1 px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full mt-1 px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input type="password" name="password" id="password" required
                        class="w-full mt-1 px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full mt-1 px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        @error('password_confirmation')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                </div>

                <!-- Password hints -->
                <div class="text-sm text-gray-500 mb-4">
                    <ul class="list-disc list-inside space-y-1">
                        <li>Minimum 8 karakter.</li>
                        <li>Sertakan huruf kapital & non-kapital.</li>
                        <li>Sertakan angka & simbol.</li>
                    </ul>
                </div>

                <div class="flex items-start mb-4">
                    <input type="checkbox" class="mr-2 mt-1" required>
                    <p class="text-sm text-gray-600">Dengan mendaftar, kamu menyetujui <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> kami.</p>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-teal-400 text-white py-3 rounded-lg hover:from-teal-500 hover:to-blue-500 transition">Daftar</button>

                <p class="mt-4 text-center text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk</a></p>
            </form>
        </div>
    </div>
</body>
</html>
