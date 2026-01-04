<?php
// penamaan alamat file didalam folder secara otomatis dibuat
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    // pembuatan fungsi index untuk melemparkan tampilan halaman
    public function index() {
        // return view('admin.index');
        return view('admin.index_demo');
    }

    // membuat fungsi untuk mengambil data product beserta relasi table stock
    public function getListProduct() {
        try {
            $listProduct = Product::with('stocks')->get();

            // mengembalikan data product berbentuk response json
            return response()->json([
                'message'   => 'get data list product successfully',
                'data'      => $listProduct
            ]);

        } catch (\Exception $error) {
            // mengembalikan pesan error berbentuk response json
            return response()->json([
                'message'   => $error->getMessage()
            ], 500); // mengembalikan pesan error internal server error
        }
    }

    // fungsi untuk melakukan logic bisnis penyimpanan data baru ke database
    public function demoStoreDataProduct(Request $request) {
        try {
            // melakukan validasi inputan yang dikiirm dari FE
             $validator = Validator::make($request->all(), [
                'name' => 'required|unique:products|max:255',
                'body' => 'required',
            ]);

            // pengecekan jika data yang dcek tidak valid
            if($validator->fails()) {

                // mengirimkan response pesan error ke FE
                return response()->json([
                    'errors'   => $validator->errors()
                ], 422);
            }

            // mengambik data yang dikirim kedalam objek validated
            $validated = $validator->validated();

            dd($validated);

        } catch (\Exception $error) {
            // mengembalikan pesan error internal server error
            return response()->json([
                'message'   => $error->getMessage()
            ], 500);
        }
    }
}
