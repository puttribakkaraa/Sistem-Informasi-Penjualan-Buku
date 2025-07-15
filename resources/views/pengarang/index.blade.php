@extends('layouts.layoutadmin')

@section('title', 'Hai Admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Pengarang</h1>
    <a href="{{ route('pengarang.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Tambah Pengarang</a>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif
<form method="GET" action="{{ route('pengarang.index') }}" class="mb-4 flex flex-wrap gap-2 items-center">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari pengarang..."
           class="border border-gray-300 px-3 py-2 rounded-md w-1/3">
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Cari</button>
    @if(request('q'))
        <a href="{{ route('pengarang.index') }}" class="text-sm text-red-600">Reset</a>
    @endif
</form>

    <table class="min-w-full table-auto bg-white rounded-md shadow-md">
        <thead>
            <tr class="border-b">
                <th class="px-4 py-2 text-left text-gray-700">Kode Pengarang</th>
                <th class="px-4 py-2 text-left text-gray-700">Nama Pengarang</th>
                <th class="px-4 py-2 text-left text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengarangs as $pengarang)
                <tr class="border-b">
                    <td class="px-4 py-2 text-gray-700">{{ $pengarang->PENGARANG_ID }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $pengarang->PENGARANG_NAMA }}</td>
                   <td class="px-4 py-2">
    <div class="flex gap-2">
        <a href="{{ route('pengarang.edit', $pengarang->PENGARANG_ID) }}" 
           class="bg-black hover:bg-gray-800 text-white px-3 py-2 rounded-md font-bold">
            Edit
        </a>

        <form id="form-delete-pengarang-{{ $pengarang->PENGARANG_ID }}"
              action="{{ route('pengarang.destroy', $pengarang->PENGARANG_ID) }}" 
              method="POST">
            @csrf
            @method('DELETE')
            <button type="button"
                    onclick="confirmDeletePengarang('{{ $pengarang->PENGARANG_ID }}')"
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
