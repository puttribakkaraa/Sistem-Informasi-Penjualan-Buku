<x-layoutadmin>
     <x-slot:title>Hai Admin</x-slot:title>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit Buku</h1>

        <form action="{{ route('buku.update', $buku->BUKU_ISBN) }}" method="POST" class="bg-white p-6 rounded-md shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="BUKU_ISBN" class="block text-gray-700">ISBN</label>
                <input type="text" id="BUKU_ISBN" name="BUKU_ISBN" class="w-full p-2 mt-2 border border-gray-300 rounded-md" value="{{ old('BUKU_ISBN', $buku->BUKU_ISBN) }}" required maxlength="13">
            </div>

            <div class="mb-4">
                <label for="BUKU_JUDUL" class="block text-gray-700">Judul Buku</label>
                <input type="text" id="BUKU_JUDUL" name="BUKU_JUDUL" class="w-full p-2 mt-2 border border-gray-300 rounded-md" value="{{ old('BUKU_JUDUL', $buku->BUKU_JUDUL) }}" required maxlength="75">
            </div>

            <div class="mb-4">
                <label for="PENERBIT_ID" class="block text-gray-700">Penerbit</label>
                <select id="PENERBIT_ID" name="PENERBIT_ID" class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                    @foreach ($penerbits as $penerbit)
                        <option value="{{ $penerbit->PENERBIT_ID }}" {{ $buku->PENERBIT_ID == $penerbit->PENERBIT_ID ? 'selected' : '' }}>
                            {{ $penerbit->PENERBIT_NAMA }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="BUKU_TGLTERBIT" class="block text-gray-700">Tanggal Terbit</label>
                <input type="date" id="BUKU_TGLTERBIT" name="BUKU_TGLTERBIT" class="w-full p-2 mt-2 border border-gray-300 rounded-md" value="{{ old('BUKU_TGLTERBIT', $buku->BUKU_TGLTERBIT) }}">
            </div>

            <div class="mb-4">
                <label for="BUKU_JMLHALAMAN" class="block text-gray-700">Jumlah Halaman</label>
                <input type="number" id="BUKU_JMLHALAMAN" name="BUKU_JMLHALAMAN" class="w-full p-2 mt-2 border border-gray-300 rounded-md" value="{{ old('BUKU_JMLHALAMAN', $buku->BUKU_JMLHALAMAN) }}">
            </div>

            <div class="mb-4">
                <label for="BUKU_DESKRIPSI" class="block text-gray-700">Deskripsi</label>
                <textarea id="BUKU_DESKRIPSI" name="BUKU_DESKRIPSI" class="w-full p-2 mt-2 border border-gray-300 rounded-md">{{ old('BUKU_DESKRIPSI', $buku->BUKU_DESKRIPSI) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="BUKU_HARGA" class="block text-gray-700">Harga</label>
                <input type="number" id="BUKU_HARGA" name="BUKU_HARGA" class="w-full p-2 mt-2 border border-gray-300 rounded-md" value="{{ old('BUKU_HARGA', $buku->BUKU_HARGA) }}" step="0.01">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Perbarui</button>
        </form>
    </div>
</body>
</x-layoutadmin>
<x-footer></x-footer>