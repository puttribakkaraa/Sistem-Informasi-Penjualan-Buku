@extends('layouts.layoutadmin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Penulis</h1>

    <a href="{{ route('admin.penerbit.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 inline-block">Tambah Penulis</a>

    {{-- ✅ Tambahkan bagian ini --}}
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif
<form method="GET" action="{{ route('admin.penerbit.index') }}" class="mb-4 flex gap-2">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama penulis..."
           class="border border-gray-300 px-3 py-2 rounded-md w-1/3">
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Cari</button>
    @if(request('q'))
        <a href="{{ route('admin.penerbit.index') }}" class="text-sm text-red-600 mt-2">Reset</a>
    @endif
</form>

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

                            <form id="form-delete-penerbit-{{ $penerbit->PENERBIT_ID }}"
                                  action="{{ route('admin.penerbit.destroy', $penerbit->PENERBIT_ID) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="confirmDeletePenerbit('{{ $penerbit->PENERBIT_ID }}')"
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
