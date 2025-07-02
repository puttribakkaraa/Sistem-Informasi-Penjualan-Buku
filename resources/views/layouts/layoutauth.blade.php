<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-teal-100 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden w-full max-w-5xl grid grid-cols-1 md:grid-cols-2">
        <!-- Ilustrasi -->
        <div class="bg-blue-100 flex flex-col items-center justify-center p-10">
            <img src="{{ asset('images/login-illustration.jpg') }}" alt="Illustration" class="w-64 h-auto mb-6 rounded-lg shadow-md">
           
            <p class="text-sm text-gray-600 mt-3 text-center">Layanan literasi Islami berkualitas.</p>
        </div>

        <!-- Konten Form -->
        <div class="p-8 md:p-10">
            @yield('content')
        </div>
    </div>
</body>
</html>
