<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AboutController;
// Route untuk home page (public)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk dashboard (protected) - menggunakan HomeController
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Route untuk konfigurasi
Route::get('/konfigurasi', [KonfigurasiController::class, 'index'])->name('konfigurasi.index');
Route::get('/konfigurasi/create', [KonfigurasiController::class, 'create'])->name('konfigurasi.create');
Route::post('/konfigurasi', [KonfigurasiController::class, 'store'])->name('konfigurasi.store');
Route::get('/konfigurasi/{id}/edit', [KonfigurasiController::class, 'edit'])->name('konfigurasi.edit');
Route::put('/konfigurasi/{id}', [KonfigurasiController::class, 'update'])->name('konfigurasi.update');

// Route untuk menu management dashboard
Route::get('/dashboard/menu', [MenuController::class, 'dashboardIndex'])->name('dashboard.menu.index');
Route::get('/dashboard/menu/create', [MenuController::class, 'create'])->name('dashboard.menu.create');
Route::post('/dashboard/menu', [MenuController::class, 'store'])->name('dashboard.menu.store');
Route::get('/dashboard/menu/{id}/edit', [MenuController::class, 'edit'])->name('dashboard.menu.edit');
Route::put('/dashboard/menu/{id}', [MenuController::class, 'update'])->name('dashboard.menu.update');
Route::delete('/dashboard/menu/{id}', [MenuController::class, 'destroy'])->name('dashboard.menu.destroy');

// Route untuk reviews
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/home', [ReviewController::class, 'getReviewsForHome'])->name('reviews.home');

// Route untuk menu (public)
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/create-simple', [MenuController::class, 'createSimple'])->name('menu.create-simple');
Route::post('/menu/store-simple', [MenuController::class, 'storeSimple'])->name('menu.store-simple');
Route::get('/section/menu', [MenuController::class, 'index'])->name('section.menu');
Route::get('/menu-content', [MenuController::class, 'getMenuContent'])->name('menu.content');


// Route untuk About management dashboard
Route::get('/dashboard/about', [AboutController::class, 'dashboardIndex'])->name('dashboard.about.index');
Route::get('/dashboard/about/create', [AboutController::class, 'create'])->name('dashboard.about.create');
Route::post('/dashboard/about', [AboutController::class, 'store'])->name('dashboard.about.store');
Route::get('/dashboard/about/{id}/edit', [AboutController::class, 'edit'])->name('dashboard.about.edit');
Route::put('/dashboard/about/{id}', [AboutController::class, 'update'])->name('dashboard.about.update');
Route::delete('/dashboard/about/{id}', [AboutController::class, 'destroy'])->name('dashboard.about.destroy');

// Route untuk review management dashboard
Route::get('/dashboard/reviews', [ReviewController::class, 'dashboardIndex'])->name('dashboard.reviews.index');
Route::get('/dashboard/reviews/create', [ReviewController::class, 'create'])->name('dashboard.reviews.create');
Route::post('/dashboard/reviews', [ReviewController::class, 'store'])->name('dashboard.reviews.store');
Route::get('/dashboard/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('dashboard.reviews.edit');
Route::put('/dashboard/reviews/{id}', [ReviewController::class, 'update'])->name('dashboard.reviews.update');
Route::delete('/dashboard/reviews/{id}', [ReviewController::class, 'destroy'])->name('dashboard.reviews.destroy');

// Route untuk paket management dashboard
Route::get('/dashboard/paket', [PaketController::class, 'dashboardIndex'])->name('dashboard.paket.index');
Route::get('/dashboard/paket/create', [PaketController::class, 'create'])->name('dashboard.paket.create');
Route::post('/dashboard/paket', [PaketController::class, 'store'])->name('dashboard.paket.store');
Route::get('/dashboard/paket/{id}/edit', [PaketController::class, 'edit'])->name('dashboard.paket.edit');
Route::put('/dashboard/paket/{id}', [PaketController::class, 'update'])->name('dashboard.paket.update');
Route::delete('/dashboard/paket/{id}', [PaketController::class, 'destroy'])->name('dashboard.paket.destroy');

// Route untuk reservasi management dashboard
Route::get('/dashboard/reservasi', [ReservasiController::class, 'dashboardIndex'])->name('dashboard.reservasi.index');
Route::get('/dashboard/reservasi/{id}', [ReservasiController::class, 'show'])->name('dashboard.reservasi.show');
Route::post('/dashboard/reservasi/{id}/status', [ReservasiController::class, 'updateStatus'])->name('dashboard.reservasi.updateStatus');

// Route untuk reservasi public
Route::get('/reservasi', [ReservasiController::class, 'create'])->name('reservasi.create');
Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
Route::get('/reservasi/success', [ReservasiController::class, 'success'])->name('reservasi.success');


Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/password/change', [AuthController::class, 'showChangePassword'])->name('dashboard.password.change');
    Route::post('/dashboard/password/update', [AuthController::class, 'processChangePassword'])->name('dashboard.password.update');
});
