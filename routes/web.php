<?php

use Illuminate\Support\Facades\Route;
// registrasi alamat file AdminController beserta dengan alamat folder
use App\Http\Controllers\AdminController;

// registrasi alamat file CashierController beserta dengan alamat folder
use App\Http\Controllers\CashierController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'verified'])->group(function () {
    // ROUTE FOR ADMIN
    Route::get('admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

    // route untuk mengambil list-product
    Route::get('list-product', [AdminController::class, 'getListProduct'])->name('list-product');
    // ROUTES FOR CASHIER
    Route::get('cashier-dashboard', [CashierController::class, 'index'])->name('cashier-dashboard');
});


require __DIR__.'/auth.php';
