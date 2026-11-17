<?php

use App\Http\Controllers\Api\{
    CashierController,
    AuthenticationController,
    ProductController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('products', [CashierController::class, 'getListProduct']);
Route::get('customers', [CashierController::class, 'getCustomer']);
Route::post('customer', [CashierController::class, 'storeCustomer']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    // mengambil data request user ketika login
    Route::get('/user', function(Request $request){
        return $request->user();
        });

        // mengambil data semua product untk mengakses list product
        Route::get('list-product', [ProductController::class, 'getListProduct']);

        // melakukan store order product oleh customer
        Route::post('order-product', [ProductController::class, 'storeOrderProduct']);

       // route untuk logout
        Route::post('logout', [AuthenticationController::class, 'logout']);

});




