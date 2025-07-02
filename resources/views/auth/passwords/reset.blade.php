@extends('layouts.layoutauth')

@section('title', 'Reset Kata Sandi')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Buat Kata Sandi Baru</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
            <input type="password" name="password" id="password" required
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition duration-200">
            Reset Kata Sandi
        </button>
    </form>
@endsection
