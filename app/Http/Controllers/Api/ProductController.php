<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Validator, DB};
use Illuminate\Support\Str;

class ProductController extends Controller {
    public function getListProduct() {
        try{
            // membuat statement untuk mengambil data products dan stocks
            $listProduct = DB::table('products')
                ->join('stocks', 'products.id', '=', 'stocks.product_id')
                ->where('stocks.status', 'in-stock')
                ->select('products.id', 'products.name','products.size','products.price','stocks.quantity')
                ->get();
            // mengembalikan data kedalam bentuk response json
            return response()->json([
                'message'   => 'get product successfully',
                'products'  => $listProduct
            ]);
        }catch(\Exception $error) {
            // mengembalikan error server dalam bentuk response json
            return response()->json([
                'error' => $error->getMessage()
            ], 500);
        }
    }
}






