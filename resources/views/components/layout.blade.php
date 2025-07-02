@props(['title'])

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Tailwind (via Vite) -->
    @vite('resources/css/app.css')

    <!-- Font & Alpine.js -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full">

<div class="min-h-full">
    <!-- Navbar -->
    <x-navbar></x-navbar>

    <!-- Judul Halaman -->
    <x-header :title="$title" />

    <!-- Konten Utama -->
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</div>

<!-- ✅ Tambahkan Footer di bawah sini -->
<x-footer />

<!-- Ini penting agar JS tambahan dari halaman (seperti slider) dimuat -->
@stack('scripts')

</body>
</html>
