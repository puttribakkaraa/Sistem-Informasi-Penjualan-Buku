@extends('layouts.layoutadmin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Link Buku Kategori</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4 shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 flex justify-between items-center">
        <a href="{{ route('admin.link_buku_kategori.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out shadow-md">
            Tambah Link Buku Kategori
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-500">
            <thead class="text-xs uppercase bg-indigo-600 text-white">
                <tr>
                    <th class="px-6 py-3 font-medium">ISBN Buku</th>
                    <th class="px-6 py-3 font-medium">ID Kategori</th>
                    <th class="px-6 py-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($linkBukuKategoris as $item)
                    <tr class="border-b hover:bg-gray-100 transition duration-200 ease-in-out">
                        <td class="px-6 py-4">{{ $item->buku_isbn }}</td>
                        <td class="px-6 py-4">{{ $item->kategori_id }}</td>
                        <td class="px-6 py-4">
        <div class="flex gap-2">
            <a href="{{ route('admin.link_buku_kategori.edit', ['buku_isbn' => $item->buku_isbn, 'kategori_id' => $item->kategori_id]) }}"
            class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-2 rounded-md font-bold transition">
                Edit
            </a>
            <form id="form-delete-{{ $item->buku_isbn }}-{{ $item->kategori_id }}" 
      action="{{ route('admin.link_buku_kategori.destroy', ['buku_isbn' => $item->buku_isbn, 'kategori_id' => $item->kategori_id]) }}" 
      method="POST">
    @csrf
    @method('DELETE')
    <button type="button"
            onclick="confirmDelete('{{ $item->buku_isbn }}', '{{ $item->kategori_id }}')"
            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md font-semibold transition">
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
</div>
@endsection
