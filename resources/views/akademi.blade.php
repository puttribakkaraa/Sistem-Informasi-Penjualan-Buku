<x-layout :title="'Akademi MCM'">

    <!-- Seksi Pengantar -->
    <div class="bg-gradient-to-b from-blue-100 via-sky-100 to-white py-16 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-8">
            <div class="w-full md:w-1/2 flex justify-center">
                <img src="/images/logomcm.jpg" alt="Ilustrasi Akademi" class="w-64 h-auto rounded-xl">
            </div>
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Apa itu Akademi MCM?</h2>
                <p class="text-gray-700 text-base leading-relaxed">
                    Akademi MCM merupakan program dari <strong>Penerbit Media Cendekia Muslim</strong> berupa pelatihan gratis
                    untuk membantu orang belajar, berkembang, dan mengeksplorasi potensi dirinya dengan dukungan & bimbingan profesional.
                </p>
            </div>
        </div>
    </div>

    <!-- Fitur Utama -->
    <div class="bg-white py-16 px-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-white p-6 rounded-xl shadow-md text-center border border-gray-100">
            <svg class="mx-auto w-12 h-12 text-blue-600 mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.97-4.03 9-9 9S3 16.97 3 12 7.03 3 12 3s9 4.03 9 9z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Komunitas</h3>
            <p class="text-sm text-gray-600">Tergabung ke dalam komunitas kreatif untuk tukar ide & wawasan.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md text-center border border-gray-100">
            <svg class="mx-auto w-12 h-12 text-green-600 mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 14l9-5-9-5-9 5 9 5zM12 14v7"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Mentor Berpengalaman</h3>
            <p class="text-sm text-gray-600">Dibimbing langsung oleh mentor profesional dan berkompeten.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md text-center border border-gray-100">
            <svg class="mx-auto w-12 h-12 text-indigo-600 mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0c-4.418 0-8-1.79-8-4v-2m16 0v2c0 2.21-3.582 4-8 4z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Pelatihan GRATIS bersama Akademi MCM</h3>
            <p class="text-sm text-gray-600">
                Penjelasan materi mudah dipahami, Dibimbing dari nol oleh mentor, Sesi praktik langsung & studi kasus, serta akses grup diskusi dan mentoring.
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md text-center border border-gray-100">
            <svg class="mx-auto w-12 h-12 text-yellow-600 mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 20l9-5-9-5-9 5 9 5z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Pengembangan Diri</h3>
            <p class="text-sm text-gray-600">Tingkatkan kemampuan soft & hard skill lewat kelas berkelas.</p>
        </div>
    </div>
</div>


    <!-- Pilihan Kelas -->
<div class="bg-sky-100 py-12">
    <div class="max-w-6xl mx-auto text-center px-4">
        <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">Pilihan Kelas</h2>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach ([
                'Menulis', 'Public Speaking', 'Dongeng', 'Ilustrasi',
                'Komik', 'Entrepreneurship', 'Penerbitan', 'Jurnalistik'
            ] as $kelas)
                <a href="https://forms.gle/Jk52pUJEgRSHF2SC7" target="_blank"
                   class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-md transition duration-200 shadow-md">
                    {{ $kelas }}
                </a>
            @endforeach
        </div>
    </div>
</div>


    <!-- Mentor Akademi -->
   <div class="bg-sky-100 py-16 px-6">
    <div class="w-full max-w-7xl mx-auto text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-10">Mentor Akademi MCM</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach ([ 
                ['label' => 'Penerbitan', 'nama' => 'Kang Sandi Permana', 'desc' => 'Owner Penerbit MCM', 'img' => 'mentor1.png'],
                ['label' => 'Kepenulisan', 'nama' => 'M Ihsan Maulana', 'desc' => 'Editor Penerbit MCM', 'img' => 'mentor2.png'],
                ['label' => 'Jurnalistik', 'nama' => 'Hilman Indrawan', 'desc' => 'Penulis Buku', 'img' => 'mentor3.png'],
                ['label' => 'Public Speaking', 'nama' => 'Rudi Herdianto', 'desc' => 'Founder Youthstore.com', 'img' => 'mentor4.png'],
                ['label' => 'Ilustrasi', 'nama' => 'Sultan Prabu', 'desc' => 'Ilustrator Buku', 'img' => 'mentor5.png'],
            ] as $mentor)
                <div class="flex flex-col items-center bg-white p-4 rounded-xl shadow border border-blue-100">
                    <p class="text-sm text-gray-500 font-medium mb-2">{{ $mentor['label'] }}</p>
                    <img src="/images/{{ $mentor['img'] }}"
                         class="w-32 h-32 object-cover rounded-2xl border-4 border-blue-700 shadow-md"
                         alt="{{ $mentor['nama'] }}">
                    <p class="mt-3 font-semibold text-gray-800">{{ $mentor['nama'] }}</p>
                    <p class="text-xs text-gray-500">{{ $mentor['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>



    <!-- Carousel Kegiatan -->
    <div class="bg-white py-24 px-12">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-xl font-semibold text-gray-800 text-center mb-6">Kegiatan di Akademi MCM</h3>
            <div class="swiper kegiatanSwiper">
                <div class="swiper-wrapper">
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="swiper-slide">
                            <img src="/images/kegiatan{{ $i }}.jpg" alt="Kegiatan {{ $i }}"
                                 class="w-40 h-40 md:w-52 md:h-52 rounded-xl shadow-md object-cover mx-auto" />
                        </div>
                    @endfor
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <!-- Testimoni -->
    <div class="bg-gradient-to-b from-blue-50 to-white py-16 px-6">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-10">Testimoni Cendekiawan</h2>
            <div class="swiper mySwiper max-w-4xl mx-auto px-4">
                <div class="swiper-wrapper">
                    @foreach ([ 
                        ['pesan' => 'Materi-materi yang diberikan mudah dipahami, dan para mentor sangat profesional di bidangnya.', 'nama' => 'Fahri Ramadhan', 'img' => 'satuu.png'],
                        ['pesan' => 'Alhamdulillah. Sekarang aku punya karya sendiri.', 'nama' => 'Moh Rizal', 'img' => 'moh.png'],
                        ['pesan' => 'Super bagus sekali acaranya. Paling mantab!', 'nama' => 'Gea Khanza', 'img' => 'gea.png']
                    ] as $t)
                        <div class="swiper-slide bg-white p-6 rounded-xl shadow-md border border-gray-100">
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

    <!-- SwiperJS -->
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
