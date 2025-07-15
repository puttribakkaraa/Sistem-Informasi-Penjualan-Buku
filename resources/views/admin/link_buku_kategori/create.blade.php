@extends('layouts.layoutadmin')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <h1 class="text-3xl font-semibold text-center mb-6">Tambah Link Buku Kategori</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.link_buku_kategori.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <div>
    <label for="buku_isbn" class="block text-sm font-medium text-gray-700">Pilih ISBN Buku</label>
    <select id="buku_isbn" name="buku_isbn"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
        <option value="" disabled selected>-- Pilih ISBN Buku --</option>
        @foreach($bukus as $buku)
            <option value="{{ $buku->BUKU_ISBN }}">{{ $buku->BUKU_ISBN }} - {{ $buku->BUKU_JUDUL }}</option>
        @endforeach
    </select>
</div>

           <div>
    <label for="KATEGORI_ID" class="block text-sm font-medium text-gray-700">Pilih Kategori</label>
    <select id="KATEGORI_ID" name="KATEGORI_ID"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" required>
        <option value="" disabled selected>-- Pilih Kategori --</option>
        @foreach($kategoris as $kategori)
            <option value="{{ $kategori->KATEGORI_ID }}">{{ $kategori->KATEGORI_NAMA }}</option>
        @endforeach
    </select>
</div>

            <div class="text-center mt-6">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
