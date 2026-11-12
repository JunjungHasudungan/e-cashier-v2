<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\{CashierController, AuthenticationController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('products', [CashierController::class, 'getListProduct']);
Route::get('customers', [CashierController::class, 'getCustomer']);
Route::post('customer', [CashierController::class, 'storeCustomer']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);
// melakukan registrasi url untuk register customer
Route::post('register-customer', [AuthenticationController::class, 'registerCustomer']);

Route::middleware(['auth:sanctum'])->group(function () {
    // mengambil data request user ketika login
    Route::get('/user', function(Request $request){
        return $request->user();
        });

        // mengambil data semua product untk mengakses list product
        Route::get('products', [AdminController::class, 'getListProduct']);

       // route untuk logout
        Route::post('logout', [AuthenticationController::class, 'logout']);
});




