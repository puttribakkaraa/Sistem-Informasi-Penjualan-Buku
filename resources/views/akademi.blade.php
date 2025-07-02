<x-layout :title="'Akademi MCM'">

    <!-- Seksi Pengantar -->
    <div class="bg-gradient-to-b from-blue-50 to-blue-100 py-16 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center md:items-start gap-8">
            <div class="w-full md:w-1/2 flex justify-center md:justify-start">
                <img src="/images/logomcm.jpg" alt="Lesson Illustration" class="w-60 h-auto">
            </div>
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Apa itu Akademi MCM?</h2>
                <p class="text-gray-700 leading-relaxed text-base">
                    Akademi MCM merupakan program dari <strong>Penerbit Media Cendekia Muslim</strong> berupa pelatihan gratis
                    untuk membantu orang belajar, berkembang, dan eksplorasi potensi diri bersama mentor profesional.
                </p>
            </div>
        </div>
    </div>

    <!-- Fitur -->
    <div class="bg-white py-16 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-md text-center border">
                <img src="/images/komunitas-icon.jpg" alt="Komunitas" class="mx-auto h-20 mb-6">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Komunitas</h3>
                <p class="text-sm text-gray-600">Tergabung ke komunitas kreatif untuk tukar ide & wawasan.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center border">
                <img src="/images/lampu.jpg" alt="Mentor" class="mx-auto h-20 mb-6">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Mentor Berpengalaman</h3>
                <p class="text-sm text-gray-600">Dibimbing langsung oleh mentor profesional.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center border">
                <img src="/images/skill-icon.jpg" alt="Pengembangan" class="mx-auto h-20 mb-6">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Pengembangan Diri</h3>
                <p class="text-sm text-gray-600">Tingkatkan soft & hard skill lewat kelas berkelas.</p>
            </div>
        </div>
    </div>

    <!-- Pelatihan Gratis -->
    <div class="bg-gradient-to-b from-blue-50 to-blue-100 py-16 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center md:items-start gap-8">
            <div class="w-full md:w-1/2 flex justify-center md:justify-start">
                <img src="/images/pelatihan.png" alt="Pelatihan" class="w-60 h-auto">
            </div>
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Pelatihan Gratis bersama Akademi MCM</h2>
                <p class="text-gray-700 leading-relaxed text-base space-y-1">
                    - Penjelasan materi mudah dipahami <br>
                    - Dibimbing dari Nol <br>
                    - Sesi praktik bersama mentor <br>
                    - Grup bimbingan dan diskusi
                </p>
            </div>
        </div>
    </div>

    <!-- Mentor Akademi -->
    <div class="bg-blue-50 py-16 px-6">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-8">Mentor Akademi MCM</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6 justify-items-center text-sm">
                @foreach ([
                    ['label' => 'Penerbitan', 'nama' => 'Kang Sandi Permana', 'desc' => 'Owner Penerbit MCM', 'img' => 'mentor1.png'],
                    ['label' => 'Kepenulisan', 'nama' => 'M Ihsan Maulana', 'desc' => 'Editor Penerbit MCM', 'img' => 'mentor2.png'],
                    ['label' => 'Jurnalistik', 'nama' => 'Hilman Indrawan', 'desc' => 'Penulis Buku', 'img' => 'mentor3.png'],
                    ['label' => 'Public Speaking', 'nama' => 'Rudi Herdianto', 'desc' => 'Founder Youthstore', 'img' => 'mentor4.png'],
                    ['label' => 'Ilustrasi', 'nama' => 'Sultan Prabu', 'desc' => 'Ilustrator Buku', 'img' => 'mentor5.png'],
                ] as $mentor)
                    <div class="flex flex-col items-center">
                        <p class="text-xs text-gray-500">{{ $mentor['label'] }}</p>
                        <img src="/images/{{ $mentor['img'] }}" class="w-20 h-20 object-cover rounded-xl border-4 border-white shadow-md mt-2" alt="">
                        <p class="font-semibold mt-1 text-sm">{{ $mentor['nama'] }}</p>
                        <p class="text-xs text-gray-500">{{ $mentor['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

  <!-- Carousel Gambar Kegiatan -->
<div class="bg-white py-12 px-6">
    <div class="max-w-6xl mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 text-center mb-6">Kegiatan di Akademi MCM</h3>

        <!-- Swiper -->
        <div class="swiper kegiatanSwiper">
            <div class="swiper-wrapper">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="swiper-slide">
                        <img src="/images/kegiatan{{ $i }}.jpg" alt="Kegiatan {{ $i }}"
                             class="w-40 h-40 md:w-52 md:h-52 rounded-xl shadow-md object-cover" />
                    </div>
                @endfor
            </div>

            <!-- Tombol Navigasi -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>



    <!-- Testimoni Cendekiawan -->
    <div class="bg-blue-50 py-16 px-6">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-10">Testimoni Cendekiawan</h2>
            <div class="swiper mySwiper max-w-4xl mx-auto px-4">
                <div class="swiper-wrapper">
                    @foreach ([
                        ['pesan' => 'Materi-materi yang diberikan mudah dipahami, dan para mentor sangat profesional di bidangnya.', 'nama' => 'Fahri Ramadhan', 'img' => 'satuu.png'],
                        ['pesan' => 'Alhamdulillah. Sekarang aku punya karya sendiri.', 'nama' => 'Moh Rizal', 'img' => 'moh.png'],
                        ['pesan' => 'Super bagus sekali acaranya. Paling mantab!', 'nama' => 'Gea Khanza', 'img' => 'gea.png']
                    ] as $t)
                        <div class="swiper-slide bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                            <div class="flex flex-col items-center">
                                <div class="text-5xl text-blue-400 font-serif mb-4">“</div>
                                <p class="text-gray-700 text-base italic mb-6 max-w-md">{{ $t['pesan'] }}</p>
                                <div class="flex items-center gap-3">
                                    <img src="/images/{{ $t['img'] }}" class="w-10 h-10 rounded-full object-cover border-2 border-blue-400" alt="{{ $t['nama'] }}">
                                    <p class="text-sm font-semibold text-gray-800">{{ $t['nama'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination mt-6"></div>
            </div>
        </div>
    </div>

    <!-- SwiperJS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.kegiatanSwiper', {
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            slidesPerView: 2,
            spaceBetween: 20,
            breakpoints: {
                640: { slidesPerView: 3 },
                768: { slidesPerView: 4 },
                1024: { slidesPerView: 5 },
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            grabCursor: true,
        });
    });
</script>


</x-layout>
