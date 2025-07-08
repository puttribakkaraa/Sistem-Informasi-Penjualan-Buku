<x-layout>
    <x-slot:title>Kirim Naskah</x-slot:title>

   <div class="bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-600 min-h-screen py-10">
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-lg">

        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">📚 Panduan Mengirim Naskah ke MCM</h1>

        <!-- Tabs -->
        <div class="flex justify-center gap-4 mb-6 border-b pb-2">
            <button onclick="showTab('fasilitas', this)" class="tab-button text-gray-600 hover:text-blue-600 px-4 py-2 font-medium transition">📦 Fasilitas</button>
            <button onclick="showTab('ketentuan', this)" class="tab-button text-gray-600 hover:text-blue-600 px-4 py-2 font-medium transition">📝 Ketentuan</button>
            <button onclick="showTab('syarat', this)" class="tab-button text-gray-600 hover:text-blue-600 px-4 py-2 font-medium transition">✅ Syarat</button>
        </div>

        <!-- Tab Content -->
        <div id="fasilitas" class="tab-content transition-opacity duration-300">
            <h2 class="text-xl font-semibold text-blue-700 mb-2">Fasilitas Penerbitan:</h2>
            <ul class="list-disc pl-5 space-y-1 text-gray-700">
                <li>📖 ISBN buku cetak dan digital</li>
                <li>📄 Surat Perjanjian Penerbitan</li>
                <li>✍️ Edit naskah bersama editor</li>
                <li>🎨 Layout & cover</li>
                <li>🛍️ Promosi di berbagai marketplace</li>
            </ul>
            <p class="mt-4 font-bold text-green-600">✅ Terbit GRATIS!</p>
        </div>

        <div id="ketentuan" class="tab-content hidden transition-opacity duration-300">
            <h2 class="text-xl font-semibold text-blue-700 mb-2">1. Format Naskah</h2>
            <ul class="list-disc pl-5 text-gray-700 space-y-1">
                <li>Ukuran A5, spasi 1 atau 1.5, font Times New Roman 12pt</li>
                <li>Margin: atas 1,5 – kiri 1,8 – kanan 1,8 – bawah 1,5 cm</li>
                <li>Nonfiksi remaja ≥ 80 halaman, fiksi ≥ 120 halaman, dll</li>
            </ul>

            <h2 class="text-xl font-semibold text-blue-700 mt-4 mb-2">2. Isi Naskah</h2>
            <ul class="list-disc pl-5 text-gray-700 space-y-1">
                <li>Kata Pengantar, Daftar Isi, Isi Buku</li>
                <li>Biodata & foto penulis</li>
                <li>Sinopsis / blurb</li>
            </ul>

            <h2 class="text-xl font-semibold text-blue-700 mt-4 mb-2">3. Pengiriman</h2>
            <p class="text-gray-700">Kirim melalui: <a href="http://bit.ly/kirimnaskahmcm" target="_blank" class="text-blue-600 underline">bit.ly/kirimnaskahmcm</a></p>
        </div>

        <div id="syarat" class="tab-content hidden transition-opacity duration-300">
            <h2 class="text-xl font-semibold text-blue-700 mb-2">1. Originalitas</h2>
            <ul class="list-disc pl-5 text-gray-700 space-y-1">
                <li>Naskah harus asli dan belum diterbitkan</li>
                <li>Penulis bertanggung jawab atas hak cipta</li>
                <li>Jika pernah diterbitkan, kontrak lama harus berakhir</li>
            </ul>

            <h2 class="text-xl font-semibold text-blue-700 mt-4 mb-2">2. Jenis Naskah</h2>
            <ul class="list-disc pl-5 text-gray-700 space-y-1">
                <li>📘 Nonfiksi: Motivasi, Biografi, Pengetahuan Umum</li>
                <li>📙 Fiksi: Novel, Cerpen, Prosa</li>
                <li>📗 Anak: Buku cerita, aktivitas, komik anak</li>
                <li>💡 Semua genre diterima</li>
            </ul>

            <h2 class="text-xl font-semibold text-blue-700 mt-4 mb-2">3. Waktu Tanggapan</h2>
            <ul class="list-disc pl-5 text-gray-700 space-y-1">
                <li>Review awal & konfirmasi dalam 3 bulan</li>
                <li>Via kontak penulis</li>
            </ul>

            <h2 class="text-xl font-semibold text-blue-700 mt-4 mb-2">4. Hak Penerbitan</h2>
            <p class="text-gray-700">📜 Jika diterima, penulis akan mendapat kontrak terkait royalti, hak cipta, dll.</p>
        </div>

        <!-- Tombol Kirim -->
        <div class="text-center mt-8">
            <p class="text-xl font-semibold text-gray-800 mb-3">Siap mengirimkan naskahmu?</p>
            <a href="http://bit.ly/kirimnaskahmcm" target="_blank"
               class="bg-gradient-to-r from-pink-600 to-red-600 hover:from-red-700 hover:to-pink-700 text-black px-6 py-3 rounded-lg font-semibold transition">
                🚀 Kirim Sekarang
            </a>
        </div>
    </div>

    <script>
        function showTab(tabId, element) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('opacity-0');
                setTimeout(() => tab.classList.add('hidden'), 300);
            });

            const activeTab = document.getElementById(tabId);
            setTimeout(() => {
                activeTab.classList.remove('hidden');
                setTimeout(() => activeTab.classList.remove('opacity-0'), 50);
            }, 300);

            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
            });
            element.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
        }

        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector('.tab-button').click();
        });
    </script>
   </div>
</x-layout>
