<?php
// penamaan alamat file didalam folder secara otomatis dibuat
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    // pembuatan fungsi index untuk melemparkan tampilan halaman
    public function index() {
        return view('admin.index');
        // return view('admin.index_demo');
    }

    public function storeProduct(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|min:3',
            'quantity' => 'required',
            ],[
                'name.required' => 'Nama produk wajib disi..',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors'    => $validator->errors()
                ], 422);
            }

            dd($validator);
        } catch(\Exception $error) {
            return response()->json([
                'errors'    => $error->getMessage()
            ], 500);
        }
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
                'name' => 'required|unique:products|min:3',
                'quantity' => 'required',
                'price' => 'required',
                'size' => 'required',
                'description' => 'required|min:5',
            ],[
                'name.required' => 'Nama produk wajib diisi',
                'name.unique'   => 'Nama produk sudah digunakan',
                'name.min'      => 'Nama minimal 3 karaktek',
                'quantity'      => 'Jumlah Produk wajib dipilih',
                'price'         => 'Harga Produk wajib diisi',
                'size'          => 'Ukuran Produk wajib dipilih',
                'description'   => 'Keterangan Produk wajib diisi',
            ]);

            // pengecekan jika data yang dcek tidak valid
            if($validator->fails()) {

                // mengirimkan response pesan error ke FE
                return response()->json([
                    'errors'   => $validator->errors()
                ], 422);
            }

            // mengambil data yang dikirim kedalam variable array
            $validated = $validator->validated();

            // menyimpan data kedalam table products
            DB::insert('INSERT INTO products
                (name, price, size, description, created_at) values (?, ?, ?, ?, ?)', [
                $validated['name'], $validated['price'], $validated['size'], $validated['description'], now()
            ]);

            // mengambil id product terakhir yang baru dibuat
            $productId = DB::getPdo()->lastInsertId();

            // menyimpan stock product
            DB::insert('INSERT INTO stocks
                (product_id, quantity, status, created_by, created_at) values (?, ?, ?, ?, ?)', [
                    $productId, $validated['quantity'], 'in-stock', auth()->user()->name, now()
            ]);

            // mengembalikan response berhasil menyimpan data baru
            return response()->json([
                'message'   => 'data produk berhasil disimpan..',
            ], 201);

        } catch (\Exception $error) {
            // mengembalikan pesan error internal server error
            return response()->json([
                'message'   => $error->getMessage()
            ], 500);
        }
    }

    // function untuk melakukan penghapusn dat produk
    public function demoDeleteProduct($productId) {
        try {
               DB::transaction(function() use ($productId) {
                    // menghapus data stock
                     DB::table('stocks')->where('product_id', $productId)->delete();

                    // menghapus data produk
                    DB::table('products')->where('id', $productId)->delete();
               });

            return response()->json([
                'message'    => 'data produk berhasil dihapus..'
            ], 200);

        } catch (\Exception $error) {
            return response()->json([
                'message'    => $error->getMessage()
            ], 500);
        }
    }
}
