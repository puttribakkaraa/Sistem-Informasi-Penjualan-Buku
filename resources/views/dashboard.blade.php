<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800 font-sans antialiased">
  <div class="flex min-h-screen">

    <!-- Sidebar -->
   <aside id="sidebar" class="bg-gradient-to-b from-blue-600 via-blue-700 to-blue-800 text-white w-64 transition-all duration-300 flex flex-col">
    <div class="flex items-center justify-between p-4 border-b border-blue-500">
        <span class="text-2xl font-bold">Media Cendekia</span>
        <button onclick="toggleSidebar()" class="text-white text-xl">☰</button>
    </div>

      <nav class="flex-1 p-4 space-y-2">
        <a href="#" class="block py-2 px-4 rounded hover:bg-grey-800 transition">Dashboard</a>
        <a href="#" class="block py-2 px-4 rounded hover:bg-grey-800 transition">Data Buku</a>
        <a href="#" class="block py-2 px-4 rounded hover:bg-grey-800 transition">Kategori</a>
        <a href="#" class="block py-2 px-4 rounded hover:bg-grey-800 transition">Penulis</a>
        <a href="#" class="block py-2 px-4 rounded hover:bg-grey-800 transition">Pengarang</a>
        <a href="#" class="block py-2 px-4 rounded hover:bg-grey-800 transition">Pesanan</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
     
        <span class="text-sm text-gray-600">Halo, Admin</span>
      </header>

      <!-- Dashboard Content -->
      <main class="p-6 space-y-6">
        <!-- Welcome Box -->
        <div class="bg-gradient-to-r from-blue-500 to-green-400 text-white rounded-xl p-6 text-center shadow-md">
          <h2 class="text-2xl font-bold">Selamat Datang Admin,</h2>
          <p class="text-sm">Tetap semangat menjalani hari ini!</p>
        </div>

        <!-- Informasi Toko -->
        <section>
          <h3 class="text-xl font-semibold mb-4 text-gray-800">Informasi Toko</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md text-center">
              <p class="text-blue-600 font-semibold">Total Buku</p>
              <p class="text-3xl font-bold">5</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center">
              <p class="text-purple-600 font-semibold">Total Kategori</p>
              <p class="text-3xl font-bold">2</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center">
              <p class="text-green-600 font-semibold">Total Penulis</p>
              <p class="text-3xl font-bold">2</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center">
              <p class="text-red-600 font-semibold">Total Penjualan</p>
              <p class="text-3xl font-bold">2</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center">
              <p class="text-indigo-600 font-semibold">Total Pengarang</p>
              <p class="text-3xl font-bold">2</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center">
              <p class="text-gray-700 font-semibold">Total Pengguna</p>
              <p class="text-3xl font-bold">4</p>
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('w-64');
      sidebar.classList.toggle('w-20');
    }
  </script>
</body>
</html>
