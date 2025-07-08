<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Pesanan Diterima</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-100 via-indigo-200 to-teal-100 flex items-center justify-center">

  <!-- Kontainer isi -->
  <div class="bg-white/90 border border-gray-200 backdrop-blur-md shadow-2xl rounded-2xl w-full max-w-md px-8 py-10 text-center">

    <!-- Subjudul -->
    <p class="text-sm text-gray-500 mb-4 font-medium tracking-wide">Toko Buku Terpercaya</p>

    <!-- Pesan -->
    <div class="bg-gradient-to-r from-blue-800 via-indigo-600 to-teal-400 text-white rounded-xl px-6 py-8 shadow-md mb-6">
      <h1 class="text-xl font-semibold leading-snug">
        Hai!
        <span class="text-white text-2xl font-extrabold block mt-2">Pesanan anda telah diterima</span>
      </h1>
    </div>

    <!-- Arahkan pengguna -->
    <p class="text-gray-600 mb-4">Klik tombol di bawah untuk melanjutkan</p>
    <a href="/Home" class="block">
      <button class="w-full bg-gradient-to-r from-blue-500 via-teal-400 to-green-500 text-white font-semibold py-3 rounded-lg shadow-md hover:from-green-500 hover:to-blue-500 transition duration-300 focus:outline-none focus:ring-2 focus:ring-teal-300">
        Lanjut
      </button>
    </a>
  </div>

</body>
</html>
