<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\Admin\DashboardAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home-user', [DashboardUserController::class, 'index'])->name('user.home');
});


Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('admin/home', [DashboardAdminController::class, 'index'])->name('admin.home');

    Route::resource('user-admin', UserAdminController::class);
    Route::resource('user-karyawan', UserKaryawanController::class);
    Route::resource('user-customer', UserCustomerController::class);

    Route::resource('kategori-produk', KategoriProdukController::class);
    Route::resource('kategori-mobil', KategoriMobilController::class);

    Route::resource('produk-mobil', ProdukMobilController::class);
    Route::resource('booking-cuci', BookingCuciController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);

    Route::get('booking-cuci-sedang-dicuci', [BookingCuciController::class, 'indexSedangDicuci'])->name('booking-cuci.sedangDicuci');
    Route::get('booking-cuci-selesai-dicuci', [BookingCuciController::class, 'indexSelesaiDicuci'])->name('booking-cuci.selesaiDicuci');
    Route::put('booking-cuci/{id}/update-status', [BookingCuciController::class, 'updateKaryawan'])->name('booking-cuci.updateKaryawan');

    Route::resource('transaction-booking', TransactionBookingController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
});
