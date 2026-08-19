<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ Customer, Product, Order, OrderDetail };
use Illuminate\Support\Facades\{Auth, Validator, DB};
use Illuminate\Support\Str;

class CashierController extends Controller
{
    public function index() {
        return view('cashier.dashboard');
    }

    public function storeOrder(Request $request) {
        try {
           
             $validator = Validator::make($request->all(), [
                'jumlah_uang' => 'required|integer',
                'type' => 'required|string',
                'order_product' => 'required|array',
            ],[
                'jumlah_uang.required' => 'jumlah uang wajib disi..',
                'jumlah_uang.integer' => 'inputan harus nominal angka',
                'type.required' => 'tipe request wajib disi..',
                'type.string' => 'inputan tipe wajib karakter',
                'order_product.required' => 'order produk wajib disi..',
                'order_product.array' => 'order product lebih dari 1 item..',
            ]);

             // mengecek jika ada pengiriman yang tidak sesuai required
            if ($validator->fails()) {
                return response()->json([
                    'errors'    => $validator->errors()
                ], 422);
            }
            $validated = $validator->validated();


            //melakukan transaksi
            DB::transaction(function() use($validated) {
                // mengambil seluruh product_id dan mengubah kedalam array
                $productIds = collect($validated['order_product'])->pluck('product_id');


                // mengambil seluruh data product melalui productIds
                $listProduct = Product::with('stocks')->whereIn('id', $productIds)->get()->keyBy('id');

                // variable penampung harga total barang yang dibeli
                $total_harga = array_reduce($validated['order_product'],function($akumulasi, $item){
                    return $akumulasi + ($item['qty'] * $item['price']);
                 },0);

                $total_item = array_reduce($validated['order_product'],function($akumulasi, $item){
                    return $akumulasi + $item['qty'];
                 },0);

                //  bagian bawah melakukan store untuk table orders
                $order = Order::create([
                    'kode_invoice' =>  Str::random(10),
                    'customer_id' => $validated['type'] == 'mobile' ? auth()->id() : null,
                    'user_id'   => $validated['type'] == 'website' ? auth()->id() : null,
                    'quantity'  => $total_item,
                    'price' => $total_harga,
                    'type' => $validated['type']
                 ]);

                // melakukan perulangan bagian order product
                foreach ($validated['order_product'] as $itemOrder) {
                    $product = $listProduct[$itemOrder['product_id']];

                    // melakukan store order_detail

                    $stock = $product->stocks->first();

                    $stock->decrement('quantity', $itemOrder['qty']);


                }

             });


            return response()->json([
                'message'=> 'transaksi berhasil'
            ], 201);

            //  dd('testing pengiriman dari cashier', $validated);
        } catch (\Throwable $th) {
            //throw $th;
             return response()->json([
                'message'=> $th->getMessage()
            ], 500);
        }

    }
}
