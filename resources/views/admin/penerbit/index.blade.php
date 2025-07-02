@extends('layouts.layoutadmin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Penulis</h1>

    <a href="{{ route('admin.penerbit.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 inline-block">Tambah Penulis</a>

    <table class="w-full table-auto bg-white shadow-md rounded-md overflow-hidden">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($penerbits as $penerbit)
                <tr class="border-b">
                    <td class="px-4 py-2 text-gray-700">{{ $penerbit->PENERBIT_ID }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $penerbit->PENERBIT_NAMA }}</td>
                    <td class="px-4 py-2">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.penerbit.edit', $penerbit->PENERBIT_ID) }}"
                                class="bg-black hover:bg-gray-800 text-white px-3 py-2 rounded-md font-bold">
                                Edit
                            </a>

                            <form action="{{ route('admin.penerbit.destroy', $penerbit->PENERBIT_ID) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md font-semibold">
                                    Hapus
                                </button>
                            </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
