<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $notifikasi = $user->notifications()->latest()->get();

        return view('notifikasi.index', compact('notifikasi'));
    }
    public function markAsRead($id)
{
    $notification = auth()->user()->notifications()->find($id);
    if ($notification) {
        $notification->markAsRead();
    }

    return response()->json(['status' => 'success']);
}

}

