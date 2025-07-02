<x-layout :title="'Notifikasi'">
    <div class="max-w-3xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-6">Notifikasi Pesanan</h2>

        @forelse (auth()->user()->notifications as $notification)
            <x-notification :notification="$notification" />
        @empty
            <div class="bg-gray-100 p-4 rounded shadow text-center text-gray-500">
                Belum ada notifikasi.
            </div>
        @endforelse
    </div>
</x-layout>
