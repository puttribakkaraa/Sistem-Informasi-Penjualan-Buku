@extends('layouts.layoutauth')

@section('title', 'Lupa Kata Sandi')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Reset Kata Sandi</h2>

    @if (session('status'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition duration-200">
            Kirim Link Reset
        </button>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Kembali ke Login</a>
        </div>
    </form>
@endsection
