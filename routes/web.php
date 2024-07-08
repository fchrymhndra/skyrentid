<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\GuestController;
// use App\Http\Controllers\CustomerController;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\AdminController;

// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // Route untuk halaman utama dan produk yang dapat diakses oleh semua pengunjung
// Route::get('/', [GuestController::class, 'home'])->name('home');
// Route::get('/produk', [GuestController::class, 'produk'])->name('produk');

// // Route untuk halaman utama dan produk yang dapat diakses oleh customer
// Route::get('/beranda', [CustomerController::class, 'beranda'])->name('beranda');
// Route::get('/produkc', [CustomerController::class, 'produkc'])->name('produkc');

// // Route untuk halaman login dan register
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Route::group(['middleware' => ['auth', 'admin']], function () {
// Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
// Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
// });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk halaman utama dan produk yang dapat diakses oleh semua pengunjung
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/produkg', [GuestController::class, 'produkg'])->name('produkg');
Route::get('/categoriesg/{category}', [GuestController::class, 'showCategory'])->name('categories.showg');

// Route untuk halaman login dan register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Routes for admin
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
    Route::post('/update-member/{id}', [AdminController::class, 'updateMember']);
    // Route untuk menampilkan semua produk
    Route::get('/produk', [ProductController::class, 'index'])->name('products');
    // Route untuk merubah status
    Route::post('/update-product-status/{id}', [ProductController::class, 'updateStatus']);
    // Route untuk menampilkan form tambah produk
    Route::get('/produk/create', [ProductController::class, 'create'])->name('products.create');
    // Route untuk menyimpan produk baru
    Route::post('/produk', [ProductController::class, 'store'])->name('products.store');
    // Route untuk menampilkan detail produk
    Route::get('/produk/{id}', [ProductController::class, 'show'])->name('products.show');
    // Route untuk menampilkan form edit produk
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    // Route untuk mengupdate produk
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('products.update');
    // Route untuk menghapus produk
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Route untuk konfirmasi penyewaan
    Route::get('/penyewaan', [RentalController::class, 'showConfirmation'])->name('admin.konfirmasi.konfsewa');

    // Route untuk menangani konfirmasi penyewaan
    Route::post('/penyewaan/{id_order}', [RentalController::class, 'confirmRental'])->name('rental.confirm');

    // Route untuk menolak penyewaan
    Route::post('/rental/reject/{id_order}', [RentalController::class, 'rejectRental'])->name('rental.reject');

    // Route untuk konfirmasi pengembalian
    Route::get('/pengembalian', [RentalController::class, 'showReturnConfirmation'])->name('admin.konfirmasi.konfkembali');

    // Route untuk menyimpan denda
    Route::post('/rental/updateDenda/{id_order}', [RentalController::class, 'updateDenda'])->name('rental.updateDenda');

    // Route untuk menangani konfirmasi pengembalian
    Route::post('/pengembalian/{id_order}', [RentalController::class, 'confirmReturn'])->name('rental.return');

    // Route untuk laporan penyewaan
    Route::get('/laporan', [RentalController::class, 'showReport'])->name('admin.laporan');

    // Route untuk Buat Excel laporan penyewaan
    Route::get('/rentals/export', [RentalController::class, 'export'])->name('rentals.export');

});

// Routes for customer
Route::group(['middleware' => ['auth', 'role:customer']], function () {
    Route::get('/beranda', [CustomerController::class, 'beranda'])->name('beranda');
    Route::get('/produkc', [CustomerController::class, 'produkc'])->name('produkc');
    Route::post('/rent', [RentalController::class, 'store'])->name('rent.store');
    Route::get('/categories/{category}', [CustomerController::class, 'showCategory'])->name('categories.show');
});

