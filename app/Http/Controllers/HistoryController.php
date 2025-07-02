<?php

// app/Http/Controllers/HistoryController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        // Ganti ini sesuai nama variabel yang kamu pakai
        $pembelianList = \App\Models\Pembelian::all(); // atau yang sesuai

        return view('pembelian.historyAdmin', compact('pembelianList'));
    }
}

