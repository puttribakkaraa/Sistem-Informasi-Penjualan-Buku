<!-- resources/views/layouts/layoutcustomer.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Media Cendekia Muslim' }}</title>
   
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Konten Utama -->
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto p-6">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <x-footer />

</body>
</html>
