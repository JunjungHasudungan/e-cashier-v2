<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Customer, Order};
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

    public function storeOrderProduct(Request $request) {
        try{
            // mengambil inputan request dari user
            $validator = Validator::make($request->all(), [
                'jumlah_uang'   => 'required|integer',
                'order_product' => 'required|array|min:1',
                'order_product.*.product_id'    => 'required|exists:products,id',
                'order_product.*.qty'    => 'required|integer|min:1',
                'order_product.*.price'    => 'required|integer|min:1',
            ], [
                'jumlah_uang.required'  => 'jumlah uang wajib diisi..',
                'order_product.*.product_id.exists'  => 'product tidak dalam record',
                'order_product.required'    => 'pesan produk tidak boleh kosong',
                'order_product.*.qty.required'    => 'jumlah produk wajib diisi',
                'order_product.*.qty.min'        => 'Jumlah produk minimal harus 1.'
            ]);

            // mengembalikan pesan error gagal validasi berbentuk json
            if($validator->fails()) {
                return response()->json(['errors'=> $validator->errors()], 422);
            }
            // mengambil data inputan yang berhasil divalidasi
            $validated = $validator->validated();

            // variable penampung harga total barang yang dibeli
            $total_harga = array_reduce($validated['order_product'],function($akumulasi, $item){
                return $akumulasi + ($item['qty'] * $item['price']);
            },0);

            //  pengecekan jumlah uang < dibandingkan dengan jumlah harga total order product
            if($validated['jumlah_uang'] < $total_harga) {
                return response()->json(['message'=> 'uang tidak cukup'], 422);
            }

            // melakukan transaksi kedatabase
            $result = DB::transaction(function() use($validated, $total_harga){
                // melakukan akumulasi total seluruh item order product
                $total_item = array_reduce($validated['order_product'],function($akumulasi, $item){
                    return $akumulasi + $item['qty'];
                 },0);

                $user = auth()->user(); //  mengambil data user yang aktif

                 // melakukan insert kedalam table order dan order_detail
                $orderId = DB::table('orders')->insertGetId([
                    'kode_invoice' =>  Str::random(10),
                    'customer_id' => $user->role == 'customer' ? $user->customer->id : null,
                    'user_id'       => $user->role == 'user' ? auth()->id() : null,
                    'quantity'  => $total_item,
                    'price' => $total_harga,
                    'type' => 'mobile',
                ]);

                //  melakukan perulangan untuk membongkar isi dari order_product
                $data = [];
                foreach ($validated['order_product'] as $item) {
                    $data [] = [
                        'product_id' => $item['product_id'],
                        'order_id' => $orderId,
                        'quantity' => $item['qty'],
                        'price' => $item['price']
                    ];
                }

                // melakukan insert kedalam tabel order_detail dari kumpulan array data
                DB::table('order_detail')->insert($data);

                // mengambil data order berdasakan dengan orderId yang diberikan
                $order = Order::select('id', 'user_id', 'customer_id', 'kode_invoice')->findOrFail($orderId);
                // memberikan nilai dalam array
                $responseOrder = [
                    'message'   =>  'transaksi berhasil',
                    'uang_kembali'  => $validated['jumlah_uang'] - $total_harga,
                    'item_order'   => $total_item,
                    'price_order'   => $total_harga,
                    'order'         => $order
                ];
                return $responseOrder; // mengembalikan data array untuk pesan yang akan dikirim
            });

            // mengembalikan response berbentuk json
            return response()->json($result, 201);
        }catch(\Exception $error) {
            return response()->json(['error', $error->getMessage()],500);
        }
    }

    function testing() {
       return response()->json(['message'=> 'testing']);
    }
}






