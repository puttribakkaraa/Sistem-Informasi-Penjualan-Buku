<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body class="font-sans antialiased" style="background-color: #B2C6D5;">


    <!-- Sidebar -->
    @include('layouts.navbaradmin')

    <!-- Main Content -->
    <div class="ml-64 transition-all duration-300" id="mainContent">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 bg-white shadow">
            <button onclick="toggleSidebar()" class="text-2xl bg-blue-200 text-white px-4 py-2 rounded hover:bg-blue-800">☰</button>

           <!-- Dropdown user -->
<div class="relative inline-block text-left">
    <button onclick="toggleDropdown()" class="flex items-center gap-2 bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full shadow hover:bg-indigo-200 transition duration-200">
        <!-- Icon user lucu -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.99 0 5.735 1.037 7.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="font-medium">Admin</span>

        <!-- Panah bawah -->
        <svg class="w-4 h-4 transform transition-transform duration-200" id="dropdownArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

      <div id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg hidden z-50">
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 hover:bg-indigo-50 text-red-600">
        <!-- Icon Logout -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-10V5a2 2 0 114 0v1" />
        </svg>Logout
    </button>
    </form>
      </div>


            </div>
        </div>

        <!-- Isi konten -->
        <div class="p-6">
            @yield('content')
        </div>
    </div>

    <!-- Script Toggle Sidebar & Dropdown -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('mainContent');

            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                main.classList.add('ml-64');
            } else {
                sidebar.classList.add('hidden');
                main.classList.remove('ml-64');
            }
        }

        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('userDropdown');
            if (!e.target.closest('#userDropdown') && !e.target.closest('button[onclick="toggleDropdown()"]')) {
                dropdown.classList.add('hidden');
            }
        });
        
    </script>
<script>
        function confirmDelete(isbn, kategoriId) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-delete-${isbn}-${kategoriId}`).submit();
                }
            });
        }
    </script>
    <script>
    function confirmDelete(isbn) {
        Swal.fire({
            title: 'Yakin ingin menghapus buku ini?',
            text: "Tindakan ini tidak bisa dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`form-delete-${isbn}`).submit();
            }
        });
    }
</script>
<script>
    function confirmDeleteKategori(kategoriId) {
        Swal.fire({
            title: 'Yakin ingin menghapus kategori ini?',
            text: "Tindakan ini tidak bisa dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`form-delete-kategori-${kategoriId}`).submit();
            }
        });
    }
</script>
<script>
    function confirmDeletePenerbit(penerbitId) {
        Swal.fire({
            title: 'Yakin ingin menghapus penulis ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`form-delete-penerbit-${penerbitId}`).submit();
            }
        });
    }
</script>
<script>
    function confirmDeletePengarang(pengarangId) {
        Swal.fire({
            title: 'Yakin ingin menghapus pengarang ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`form-delete-pengarang-${pengarangId}`).submit();
            }
        });
    }
</script>

</body>
</html>
