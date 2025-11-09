<?php
// penamaan alamat file didalam folder secara otomatis dibuat
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    // pembuatan fungsi index untuk melemparkan tampilan halaman
    public function index() {
        return view('admin.index');
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
}
