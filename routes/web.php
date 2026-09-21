<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\PelangganAuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SawController;
use App\Http\Controllers\TestEmailController;

/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD
|--------------------------------------------------------------------------
*/

Route::get(
    '/forgot-password',
    [ForgotPasswordController::class, 'form']
)->name('password.request');

Route::post(
    '/forgot-password',
    [ForgotPasswordController::class, 'kirimOtp']
)->name('password.email');

Route::get(
    '/verifikasi-otp',
    [ForgotPasswordController::class, 'otpForm']
)->name('password.otp');

Route::post(
    '/verifikasi-otp',
    [ForgotPasswordController::class, 'verifikasiOtp']
)->name('password.verify');

Route::get(
    '/reset-password',
    [ForgotPasswordController::class, 'resetForm']
)->name('password.reset.form');

Route::post(
    '/reset-password',
    [ForgotPasswordController::class, 'resetPassword']
)->name('password.reset');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('admin')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // Produk
        Route::resource('produk', ProdukController::class);

        // Pelanggan
        Route::resource('pelanggan', PelangganController::class);

        // Pesanan
        Route::resource('pesanan', PesananController::class);

        // Metode Pembayaran
        Route::resource(
            'metode-pembayaran',
            MetodePembayaranController::class
        );

        // Pesan & Review Pelanggan
        Route::get(
            '/kontak',
            [KontakController::class, 'index']
        )->name('kontak.index');

        Route::put(
            '/kontak/{id}/balas',
            [KontakController::class, 'balas']
        )->name('kontak.balas');

        // Laporan
        Route::get(
            '/laporan',
            [PesananController::class, 'laporan']
        )->name('pesanan.laporan');

        Route::get(
            '/laporan/pdf',
            [PesananController::class, 'exportPdf']
        )->name('pesanan.pdf');

        // Update Status Pesanan
        Route::put(
            '/pesanan/{id}/status',
            [PesananController::class, 'updateStatus']
        )->name('pesanan.updateStatus');

        // SAW Produk Unggulan
        Route::get(
            '/produk-unggulan',
            [SawController::class, 'index']
        )->name('admin.saw');
    });


/*
|--------------------------------------------------------------------------
| AUTH PELANGGAN
|--------------------------------------------------------------------------
*/

Route::get(
    '/register-pelanggan',
    [PelangganAuthController::class, 'registerForm']
)->name('pelanggan.register');

Route::post(
    '/register-pelanggan',
    [PelangganAuthController::class, 'register']
);

Route::get(
    '/login-pelanggan',
    [PelangganAuthController::class, 'loginForm']
)->name('pelanggan.login');

Route::post(
    '/login-pelanggan',
    [PelangganAuthController::class, 'login']
);

Route::get(
    '/logout-pelanggan',
    [PelangganAuthController::class, 'logout']
)->name('pelanggan.logout');

Route::get(
    '/dashboard-pelanggan',
    [PelangganAuthController::class, 'dashboard']
)->name('pelanggan.dashboard');


/*
|--------------------------------------------------------------------------
| PELANGGAN
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [ProdukController::class, 'landing']);

// Produk
Route::get(
    '/produk',
    [ProdukController::class, 'produkPelanggan']
);

// Checkout
Route::post(
    '/checkout',
    [PesananController::class, 'checkout']
)->name('checkout');

// Pesanan Saya
Route::get(
    '/pesanan-saya',
    [PesananController::class, 'pesananSaya']
)->name('pesanan.saya');

// Kirim Pesan & Review
Route::post(
    '/kontak',
    [KontakController::class, 'store']
)->name('kontak.store');


/*
|--------------------------------------------------------------------------
| TEST EMAIL
|--------------------------------------------------------------------------
*/

Route::get(
    '/test-email',
    [TestEmailController::class, 'index']
);