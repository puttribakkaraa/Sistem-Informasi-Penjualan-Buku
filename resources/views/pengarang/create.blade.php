@extends('layouts.layoutadmin')

@section('title', 'Hai Admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Pengarang</h1>

    <form action="{{ route('pengarang.store') }}" method="POST" class="bg-white p-6 rounded-md shadow-md">
        @csrf
        <div class="mb-4">
            <label for="PENGARANG_ID" class="block text-gray-700">Kode Pengarang</label>
            <input type="text" id="PENGARANG_ID" name="PENGARANG_ID" value="{{ $newId }}" readonly
    class="w-full p-2 mt-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">

        </div>

        <div class="mb-4">
            <label for="PENGARANG_NAMA" class="block text-gray-700">Nama Pengarang</label>
            <input type="text" id="PENGARANG_NAMA" name="PENGARANG_NAMA"
                class="w-full p-2 mt-2 border border-gray-300 rounded-md" required maxlength="30">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
    </form>
</div>
@endsection
