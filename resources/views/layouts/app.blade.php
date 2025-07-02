<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-green-700 text-white min-h-screen sticky top-0 hidden md:block">
        <div class="p-6 text-lg font-bold border-b border-green-600">
            📘 Media Cendekia
        </div>
        <nav class="mt-6 space-y-2 text-sm">
            <a href="/admin/dashboard" class="block py-2 px-4 hover:bg-green-800">Dashboard</a>
            <a href="/admin/buku" class="block py-2 px-4 hover:bg-green-800">Data Buku</a>
            <a href="/admin/categories" class="block py-2 px-4 hover:bg-green-800">Kategori</a>
            <a href="/admin/publishers" class="block py-2 px-4 hover:bg-green-800">Penerbit</a>
            <a href="/admin/orders" class="block py-2 px-4 hover:bg-green-800">Pesanan</a>
        </nav>
    </aside>

    <!-- Konten Utama -->
    <div class="flex-1">
        <!-- Navbar Top -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800">@yield('title')</h1>
            <div class="text-sm text-gray-600">Hai, Admin 👋</div>
        </header>

        <!-- Konten -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
