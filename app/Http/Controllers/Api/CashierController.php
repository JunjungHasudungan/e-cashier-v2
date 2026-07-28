<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, DB};

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
                'message'=> 'testing  badai',
                'response' => $listCustomer
            ], 200);

        } catch (\Throwable $th) {
           return response()->json([
            'message'=> $th->getMessage()
            ], 500);
        }

    }

    public function storeCustomer(Request $request){
        try{
             $validator = Validator::make($request->all(), [
            'company_name' => 'required|unique:customers|min:3',
            'contact_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'phone' => 'required',
            ],[
                'company_name.required' => 'nama Perusahaan wajib disi..',
                'contact_name.required' => 'nama Kontak Wajib dipilh',
                'address.required' => 'alamat wajib disi..',
                'city.required' => 'nama kota wajib dipilih..',
                'postal_code.required' => 'kode pos wajib disi..',
                'country.required' => 'nama negara wajib disi..',
                'phone.required' => 'nomor telepon wajib disi..',
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
            $customer = DB::table('customers')->insert([
                'company_name' =>  $validated['company_name'],
                'contact_name' => $validated['contact_name'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
                'phone' => $validated['phone'],
            ]);

            // mengembalikan response json
            return response()->json(['message'   => 'customer berhasil dibuat', 'response'=> $customer], 201);

        }catch(\Exception $error) {
            return response()->json(['error'   => $error->getMessage()], 500);
        }
    }
}
