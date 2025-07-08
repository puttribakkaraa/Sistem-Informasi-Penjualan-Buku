<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DaftarBukuController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukuController2;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\TambahBukuController;
use App\Http\Controllers\LinkBukuKategoriController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\BukuBeforeController;
use App\Http\Controllers\AkademiController;
use App\Http\Controllers\HomeBeforeController;
use App\Http\Controllers\UlasanController;


Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

Route::get('/home-before', [HomeBeforeController::class, 'index'])->name('home.before');
Route::get('/buku/{isbn}', [\App\Http\Controllers\BukuController::class, 'show'])->name('buku.detail');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store')->middleware('auth');

Route::get('/kirim-naskah', function () { return view('kirim-naskah');});
Route::post('/owner/logout', [OwnerController::class, 'logout'])->name('owner.logout');

Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])->middleware('auth');
Route::get('/dashboardowner', [OwnerController::class, 'index'])->name('dashboardowner');

Route::get('/akademi', [AkademiController::class, 'index']);



Route::get('/BukuBefore', [BukuController::class, 'bukuBefore'])->name('buku.before');
Route::get('/SearchBefore', [BukuBeforeController::class, 'searchBefore'])->name('SearchBefore');





Route::get('/form-search', function () { return view('search', ['books' => collect()]); })->name('form.search');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/CariKategori', [BukuController::class, 'filterBuku'])->name('CariKategori');
Route::get('/Search', [BukuController::class, 'searchByHarga'])->name('Search');

Route::get('/search-judul', [BukuController::class, 'searchBinary'])->name('buku.searchBinaryCustomer');

// ================= ROUTE UTAMA =================
Route::get('/', [BukuController::class, 'index2']);

// ========== AUTH =============
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// ========== ADMIN AUTH =============
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::resource('penerbit', PenerbitController::class);
});

// ========== BUKU =============
Route::resource('buku', BukuController::class);
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

Route::get('/Buku', [DaftarBukuController::class, 'index'])->name('Buku.index');
Route::get('search-judul', [BukuController::class, 'searchBinary'])->name('buku.searchBinaryCustomer');
Route::put('/buku/{BUKU_ISBN}', [BukuController::class, 'update'])->name('buku.update');


// ========== KATEGORI =============
Route::resource('kategori', KategoriController::class);
Route::resource('pengarang', PengarangController::class);

// ========== PEMBELIAN =============
Route::middleware('auth')->group(function () {
    Route::get('/pembelian', [PembelianController::class, 'tampil'])->name('pembelian.tampil');
    Route::post('/pembelian/store', [PembelianController::class, 'checkout'])->name('pembelian.store');
    Route::get('/pembelian/history', [PembelianController::class, 'history'])->name('pembelian.history');
    Route::put('/pembelian/{id}/updateStatusUser', [PembelianController::class, 'updateStatusUser'])->name('pembelian.updateStatusUser');
    Route::post('/checkout', [PembelianController::class, 'checkout'])->name('checkout');
});
Route::get('/pembelian/historyAdmin', [PembelianController::class, 'historyAdmin'])->name('pembelian.historyAdmin');
Route::put('/pembelian/{id}/updateStatus', [PembelianController::class, 'updateStatus'])->name('pembelian.updateStatus');

// ========== CART =============
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// ========== OWNER =============
Route::middleware(['auth', 'owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'index'])->name('dashboard');
    Route::get('/buku-terlaris', [OwnerController::class, 'bukuTerlaris'])->name('buku_terlaris');
    Route::get('/laporan', [OwnerController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/export-excel', [OwnerController::class, 'exportExcel'])->name('laporan_excel');
    Route::get('/riwayat-pembelian', [OwnerController::class, 'riwayat'])->name('riwayat');
    Route::get('/detail-penjualan', [OwnerController::class, 'detailPenjualan'])->name('detail_penjualan');
    Route::get('/stok-buku', [OwnerController::class, 'stokBuku'])->name('stok_buku');



});
Route::get('/owner/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan.index');
Route::get('/owner/laporan-penjualan/cetak', [LaporanPenjualanController::class, 'cetakPDF'])->name('laporan.cetak');
Route::get('/laporan-penjualan/pdf', [LaporanPenjualanController::class, 'exportPdf'])->name('laporan.penjualan.pdf');

// ========== NOTIFIKASI =============
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])->middleware('auth');
Route::post('/notifikasi/read/{id}', function ($id) {
    $notif = auth()->user()->notifications()->find($id);
    if ($notif) {
        $notif->markAsRead();
    }
    return response()->json(['success' => true]);
})->middleware('auth');

// ========== HALAMAN TAMBAHAN =============
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
Route::get('/dashboard2', fn () => view('dashboard2'))->name('dashboard2');
Route::get('/dashboard3', fn () => view('dashboard3'));
Route::get('/qrCode', fn () => view('qrCode'));
Route::get('/Home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/HomeAdmin', [HomeAdminController::class, 'index'])->name('HomeAdmin');

// ========== LINK BUKU KATEGORI =============
Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('link-buku-kategori')->name('link_buku_kategori.')->group(function () {
        Route::get('/', [LinkBukuKategoriController::class, 'index'])->name('index');
        Route::get('/create', [LinkBukuKategoriController::class, 'create'])->name('create');
        Route::post('/', [LinkBukuKategoriController::class, 'store'])->name('store');
        Route::get('/{buku_isbn}/{kategori_id}/edit', [LinkBukuKategoriController::class, 'edit'])->name('edit');
        Route::put('/{buku_isbn}/{kategori_id}', [LinkBukuKategoriController::class, 'update'])->name('update');
        Route::delete('/{buku_isbn}/{kategori_id}', [LinkBukuKategoriController::class, 'destroy'])->name('destroy');
    });
});

// ========== LUPA PASSWORD =============
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
