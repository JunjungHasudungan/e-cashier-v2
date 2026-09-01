<?php

use App\Http\Controllers\Api\AuthenticationExample;
use App\Http\Controllers\Api\CashierController;
use Illuminate\Http\Request;
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
Route::get('order/{customerId}/detail', [CashierController::class, 'getOrderDetailCustomer']);
Route::post('checkout-order', [CashierController::class,'storeOrder']);
Route::post('register', [AuthenticationExample::class, 'register']);
Route::post('logout', [AuthenticationExample::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
