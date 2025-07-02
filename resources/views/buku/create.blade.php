@extends('layouts.layoutadmin')

@section('title', 'Tambah Buku')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Buku</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Terjadi kesalahan:</strong>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-md shadow-md">
        @csrf

        <div class="mb-4">
            <label for="BUKU_ISBN" class="block text-gray-700">ISBN</label>
            <input type="text" id="BUKU_ISBN" name="BUKU_ISBN" class="w-full p-2 mt-2 border border-gray-300 rounded-md" required maxlength="20">
        </div>

        <div class="mb-4">
            <label for="BUKU_JUDUL" class="block text-gray-700">Judul Buku</label>
            <input type="text" id="BUKU_JUDUL" name="BUKU_JUDUL" class="w-full p-2 mt-2 border border-gray-300 rounded-md" required maxlength="75">
        </div>
     

        <div class="mb-4">
            <label for="stok" class="block text-gray-700">Stok Buku</label>
            <input type="number" name="stok" id="stok" class="w-full p-2 mt-2 border border-gray-300 rounded-md" value="0" required>
        </div>


        <div class="mb-4">
            <label for="PENERBIT_ID" class="block text-gray-700">Penulis</label>
            <select id="PENERBIT_ID" name="PENERBIT_ID" class="w-full p-2 mt-2 border border-gray-300 rounded-md">
                @foreach ($penerbits as $penerbit)
                    <option value="{{ $penerbit->PENERBIT_ID }}">{{ $penerbit->PENERBIT_NAMA }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="BUKU_TGLTERBIT" class="block text-gray-700">Tanggal Terbit</label>
            <input type="date" id="BUKU_TGLTERBIT" name="BUKU_TGLTERBIT" class="w-full p-2 mt-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="BUKU_JMLHALAMAN" class="block text-gray-700">Jumlah Halaman</label>
            <input type="number" id="BUKU_JMLHALAMAN" name="BUKU_JMLHALAMAN" class="w-full p-2 mt-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="BUKU_DESKRIPSI" class="block text-gray-700">Deskripsi</label>
            <textarea id="BUKU_DESKRIPSI" name="BUKU_DESKRIPSI" class="w-full p-2 mt-2 border border-gray-300 rounded-md"></textarea>
        </div>

        <div class="mb-4">
            <label for="BUKU_HARGA" class="block text-gray-700">Harga</label>
            <input type="number" id="BUKU_HARGA" name="BUKU_HARGA" class="w-full p-2 mt-2 border border-gray-300 rounded-md" step="0.01">
        </div>

        <div class="mb-4">
            <label for="BUKU_GAMBAR" class="block text-gray-700">Gambar Buku</label>
            <input type="file" id="BUKU_GAMBAR" name="BUKU_GAMBAR" class="w-full p-2 mt-2 border border-gray-300 rounded-md" accept="image/*">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
    </form>
</div>
@endsection
