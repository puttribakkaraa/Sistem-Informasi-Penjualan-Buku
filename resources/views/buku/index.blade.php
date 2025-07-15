@extends('layouts.layoutadmin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold text-white-900 mb-4">Daftar Buku</h1>
    <a href="{{ route('buku.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Tambah Buku</a>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif
<form method="GET" action="{{ route('buku.index') }}" class="mb-4 flex gap-2">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari berdasarkan judul atau ISBN..."
        class="border border-gray-300 px-3 py-2 rounded-md w-1/3">
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Cari</button>
    @if(request('q'))
        <a href="{{ route('buku.index') }}" class="text-sm text-red-600 mt-2">Reset</a>
    @endif
</form>

    <table class="min-w-full table-auto bg-white rounded-md shadow-md">
        <thead>
            <tr class="border-b">
                <th class="px-4 py-2 text-left text-gray-700">GAMBAR</th>
                <th class="px-4 py-2 text-left text-gray-700">ISBN</th>
                <th class="px-4 py-2 text-left text-gray-700">JUDUL</th>
                <th class="px-4 py-2 text-left text-gray-700">Stok</th>
                <th class="px-4 py-2 text-left text-gray-700">Penerbit</th>
                <th class="px-4 py-2 text-left text-gray-700">Harga</th>
                <th class="px-4 py-2 text-left text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody>
           @foreach($bukuList as $buku)

            <tr class="border-b">
                <td class="px-4 py-2">
                    @if ($buku->BUKU_GAMBAR)
                        <img src="{{ asset('images/' . $buku->BUKU_GAMBAR) }}" alt="Cover Buku" class="w-16 h-20 object-cover rounded">
                    @else
                        <span class="text-gray-400 italic">Tidak ada gambar</span>
                    @endif
                </td>
                <td class="px-4 py-2 text-gray-700">{{ $buku->BUKU_ISBN }}</td>
                <td class="px-4 py-2 text-gray-700">{{ $buku->BUKU_JUDUL }}</td>
                <td class="px-4 py-2 text-gray-700">{{ $buku->stok }}</td>
                <td class="px-4 py-2 text-gray-700">{{ $buku->penerbit->PENERBIT_NAMA }}</td>
                <td class="px-4 py-2 text-gray-700">{{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</td>    
               <td class="px-4 py-2">
    <div class="flex gap-2">
        <a href="{{ route('buku.edit', $buku->BUKU_ISBN) }}" 
           class="bg-black hover:bg-gray-800 text-white px-3 py-2 rounded-md font-bold">Edit</a>

        <form id="form-delete-{{ $buku->BUKU_ISBN }}" 
              action="{{ route('buku.destroy', $buku->BUKU_ISBN) }}" 
              method="POST">
            @csrf
            @method('DELETE')
            <button type="button"
                    onclick="confirmDelete('{{ $buku->BUKU_ISBN }}')"
                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md font-semibold">
                Hapus
            </button>
        </form>
    </div>
</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
