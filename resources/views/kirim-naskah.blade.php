<x-layout>
    <x-slot:title>Kirim Naskah</x-slot:title>

    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">Panduan Mengirim Naskah ke MCM</h1>

      <div class="flex space-x-4 border-b mb-4">
    <button onclick="showTab('fasilitas', this)" class="tab-button px-4 py-2 border rounded-t hover:bg-blue-50">Fasilitas Penerbitan</button>
    <button onclick="showTab('ketentuan', this)" class="tab-button px-4 py-2 border rounded-t hover:bg-blue-50">Ketentuan Naskah</button>
    <button onclick="showTab('syarat', this)" class="tab-button px-4 py-2 border rounded-t hover:bg-blue-50">Syarat Umum</button>
</div>



        <!-- Tab Contents -->
        <div id="fasilitas" class="tab-content block">
            <p><strong>Fasilitas penerbitan:</strong></p>
            <ul class="list-disc pl-5 mt-2">
                <li>ISBN buku cetak dan digital</li>
                <li>Surat Perjanjian Penerbitan (hak dan kewajiban dua belah pihak)</li>
                <li>Edit naskah (konsultasi dua arah editor dan penulis)</li>
                <li>Layout dan cover</li>
                <li>Promosi dan penjualan di marketplace, toko buku, dan toko buku digital</li>
            </ul>
            <p class="mt-2 font-bold">Terbit GRATIS!</p>
        </div>

        <div id="ketentuan" class="tab-content hidden">
            <h2 class="font-bold mb-2">1. Format Naskah</h2>
            <ul class="list-disc pl-5">
                <li>Naskah diketik ukuran A5, spasi 1 atau 1,5</li>
                <li>Font Times New Roman ukuran 12pt</li>
                <li>Margin atas 1,5 – kiri 1,8 – kanan 1,8 – bawah 1,5 cm</li>
                <li>Nonfiksi remaja minimal 80 halaman</li>
                <li>Fiksi remaja minimal 120 halaman</li>
                <li>Fiksi/nonfiksi dewasa minimal 150 halaman</li>
                <li>Fiksi anak minimal 60 halaman</li>
                <li>Buku cerita anak bergambar minimal 30 halaman</li>
            </ul>

            <h2 class="font-bold mt-4 mb-2">2. Isi Naskah</h2>
            <ul class="list-disc pl-5">
                <li>Kata Pengantar</li>
                <li>Daftar Isi</li>
                <li>Isi buku</li>
                <li>Biodata penulis</li>
                <li>Foto kasual</li>
                <li>Sinopsis/blurb</li>
            </ul>

            <h2 class="font-bold mt-4 mb-2">3. Pengiriman</h2>
            <p>Naskah dikirimkan ke tautan berikut: <a class="text-blue-600 underline" href="http://bit.ly/kirimnaskahmcm">bit.ly/kirimnaskahmcm</a></p>
        </div>

        <div id="syarat" class="tab-content hidden">
            <h2 class="font-bold mb-2">1. Originalitas:</h2>
            <ul class="list-disc pl-5">
                <li>Naskah harus karya asli dan <strong>belum pernah diterbitkan</strong></li>
                <li>Penulis bertanggung jawab atas orisinalitas dan hak cipta</li>
                <li>Jika pernah diterbitkan, harus memastikan kontrak sebelumnya telah berakhir</li>
            </ul>

            <h2 class="font-bold mt-4 mb-2">2. Jenis Naskah:</h2>
            <ul class="list-disc pl-5">
                <li><strong>Nonfiksi:</strong> Motivasi, Biografi, Referensi, Pengetahuan Umum, dll</li>
                <li><strong>Fiksi:</strong> Novel, Puisi, Cerpen, Prosa, dll</li>
                <li><strong>Buku Anak:</strong> Buku Aktivitas, Buku Cerita, Komik Anak, dll</li>
                <li>Menerima semua genre</li>
            </ul>

            <h2 class="font-bold mt-4 mb-2">3. Waktu Tanggapan:</h2>
            <ul class="list-disc pl-5">
                <li>Naskah akan melalui tahap review awal</li>
                <li>Konfirmasi kurang dari 3 bulan</li>
                <li>Tanggapan via kontak penulis</li>
            </ul>

            <h2 class="font-bold mt-4 mb-2">4. Hak Penerbitan:</h2>
            <p>Jika diterima, penerbit akan menawarkan kontrak termasuk hak cipta, royalti, dll.</p>
        </div>

        <!-- Tombol Kirim -->
        <div class="text-center mt-6">
            <p class="font-semibold text-lg mb-2">Kirim Naskah Sekarang!</p>
            <a href="http://bit.ly/kirimnaskahmcm" target="_blank" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">Kirim</a>
        </div>
    </div>
<script>
    function showTab(tabId, element) {
        // SEMUA konten tab disembunyikan dengan transisi
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('opacity-0');
            setTimeout(() => tab.classList.add('hidden'), 300); // delay agar opacity jalan
        });

        // TAMPILKAN yang dipilih dengan transisi
        const activeTab = document.getElementById(tabId);
        setTimeout(() => {
            activeTab.classList.remove('hidden');
            setTimeout(() => activeTab.classList.remove('opacity-0'), 50);
        }, 300);

        // Reset semua tab-button ke default
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('text-blue-600', 'font-semibold');
            const underline = btn.querySelector('.underline-bar');
            if (underline) underline.style.width = '0';
        });

        // Tambahkan efek aktif ke yang diklik
        element.classList.add('text-blue-600', 'font-semibold');
        const activeUnderline = element.querySelector('.underline-bar');
        if (activeUnderline) activeUnderline.style.width = '100%';
    }

    // Auto klik default tab saat pertama kali load
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelector('.tab-button').click();
    });
</script>


</x-layout>
