<?php
// penamaan alamat file didalam folder secara otomatis dibuat
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    // fungsi untuk megambil data product berdasarkan productId
    public function getProductById($productId) {
        try {
            // mengambil data kedalam table product
            $product = Product::where('id', $productId)->with(['stocks' => function($query) {
                $query->where('status', 'in-stock');
            }])->first();

            // menimpa nilai product quantity ke front-end
            $dataProduct = [
                'product_id'    => $product->id,
                'name'          => $product->name,
                'size'          => $product->size,
                'quantity'      => optional($product->stocks->first())->quantity ?? 0,
                'description'   => $product->description
            ];

            // mengembalikan data response berbentuk json
           return response()->json([
            'message'   => 'get product successfully',
            'response'      => $dataProduct
           ]);
        } catch (\Exception $error) {
            // mengembalikan response error berbentuk json
            return response()->json([
                'message'   => $error->getMessage()
            ]);
        }
     }

    // pembuatan fungsi index untuk melemparkan tampilan halaman
    public function index() {
        return view('admin.index');
        // return view('admin.index_demo');
    }

    public function storeProduct(Request $request) {
        try{
            // melakukan validasi seluruh pengiriman request
            $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|min:3',
            'size' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            ],[
                'name.required' => 'Nama produk wajib disi..',
                'size.required' => 'Ukuran Wajib dipilh',
                'price.required' => 'Harga produk wajib disi..',
                'quantity.required' => 'Jumlah produk wajib dipilih..',
                'description.required' => 'Keterangan produk wajib disi..',
            ]);

            // mengecek jika ada pengiriman yang tidak sesuai required
            if ($validator->fails()) {
                return response()->json([
                    'errors'    => $validator->errors()
                ], 422);
            }

            // mengumpulkan seluruh data request kedalam array
            $validated = $validator->validated();

            // melakukan insert data kedalam table products
            $product = DB::table('products')->insert([
                'name' =>  $validated['name'],
                'size' => $validated['size'],
                'price' => $validated['price'],
                // 'quantity' => $validated['name'],
                'description' => $validated['description'],
            ]);

            // mengambil data id product
            $productId = DB::getPdo()->lastInsertId();

            // melakukan insert data ke table stocks
            DB::insert('INSERT INTO stocks
            (quantity, product_id, status, created_by, created_at) values
            (?, ?, ?, ?, ?)',
            [ $validated['quantity'],  $productId, 'in-stock', auth()->user()->name,  now()
            ]);

            // mengirim response berhasil ke front-end
            return response()->json([
                'message'    => 'Created product successfully'
            ], 201);


        } catch(\Exception $error) {
            return response()->json([
                'errors'    => $error->getMessage()
            ], 500);
        }
    }

    // membuat fungsi untuk mengambil data product beserta relasi table stock
    public function getListProduct() {
        try {
            // mengubah query untuk mengambil data product dengan relasi stocks dimana status adalah in-stock
            $listProduct = Product::with(['stocks' => function($query){
                $query->where('status', 'in-stock');
            }])->get();

            // merubah format response API dengan cara maping data
            $dataListProduct = $listProduct->map(function($product){
                return [
                    'id'            => $product->id,
                    'name'          => $product->name,
                    'size'          => $product->size,
                    'stocks'        => $product->stocks->first(),
                    'price'         => $product->price,
                    'description'   => $product->description,
                ];
            });


            // mengembalikan data product berbentuk response json
            return response()->json([
                'message'   => 'get data list product successfully',
                'data'      => $dataListProduct
            ]);

        } catch (\Exception $error) {
            // mengembalikan pesan error berbentuk response json
            return response()->json([
                'message'   => $error->getMessage()
            ], 500); // mengembalikan pesan error internal server error
        }
    }

    // fungsi untuk menghapus data product melalui variable parameter
    public function deleteProduct($productId) {
        try {
            // menemukan data product melalui class model Product
            $product = Product::with('stocks')->findOrFail($productId);

            // mengecek jika ada data relasi stock ke table product untuk menghapus data stock
            if($product->stocks()->exists()) {
                // menghapus data stocks terlebih dahulu
                $product->stocks()->delete();
                // menghapus data product
                $product->delete();
            }
            // langsung menghapus data product
            $product->delete();
            // mengengembalikan response pesan berbentuk json ke frontend
            return response()->json([
                'message'   => 'produk berhasil dihapus'
            ],200);
        } catch (\Exception $error) {
            //mengembalikan pesan error ke frontend
            return response()->json([
                'error' => $error->getMessage()
            ], 500);
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
