<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function getListProduct() {
        dd('mengambil data product');
    }
    public function getCustomer() {
        try {
            //code...
            // mengambil data melalui model
            $listCustomer = Customer::all();

            return response()->json([
                'message'=> '',
                'response' => $listCustomer
            ], 200);

        } catch (\Throwable $th) {
           return response()->json([
            'message'=> $th->getMessage()
            ], 500);
        }

    }
}
