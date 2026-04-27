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
    // ====== ROUTE FOR ADMIN =======
    Route::get('admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

    // nama url untuk mengambil list-product
    Route::get('products', [AdminController::class, 'getListProduct'])->name('products.list');

    // mengirim data ke BE
    Route::post('product', [AdminController::class, 'storeProduct'])->name('product.store');

    // jalur mengambil data product berdasarkan productId
    Route::get('product/{productId}/show', [AdminController::class, 'getProductById'])->name('product.show');

    // jalur untuk menghapus data product berdasaarkan parameter yang dikirim dari frontend
    Route::delete('product/{productId}/delete', [AdminController::class, 'deleteProduct'])
        ->name('product.delete');

    // route untuk melakukan store data demo create produk
    Route::post('demo-store-product', [AdminController::class, 'demoStoreDataProduct'])->name('demo-store-product');

    // route untuk melakukn penghapusan demo delete produk
    Route::delete('demo-delete-product/{productId}', [AdminController::class, 'demoDeleteProduct'])->name('demo-delete-product');

    Route::view('profits', 'admin.profits.index')->name('profits');

    // ROUTES FOR CASHIER
    Route::get('cashier-dashboard', [CashierController::class, 'index'])->name('cashier-dashboard');
});


require __DIR__.'/auth.php';
