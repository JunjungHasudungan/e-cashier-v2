<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Customer};
use Illuminate\Support\Facades\{Validator, Hash};

class AuthenticationController extends Controller
{
    public function login(Request $request) {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password'=> 'required'
            ], [
                'email.required' => 'email wajib diisi..',
                'password.required' => 'password wajib diisi....',
            ]);

        if ($validator->fails()) {
            return response()->json([
                'errors'=> $validator->errors()
            ], 422);
        }

        // Retrieve the validated input...
        $validated = $validator->validated();

        #mengambil data user by email
        $user = User::where('email',$validated['email'])->first();
        if($user) {
            if (!Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'message' => 'Email atau password salah',
                ], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;


            return response()->json([
                'message' => 'login successfuly',
                'role'      => 'user',
                'token'     => $token
            ], 200);
        }

        # mengambil data customer by email
        $customer = Customer::where('email',$validated['email'])->first();

        if($customer) {
            if (!Hash::check($validated['password'], $customer->password)) {
                return response()->json([
                    'message' => 'Email atau password salah',
                ], 401);
            }
            $token = $customer->createToken('auth_token')->plainTextToken;

             return response()->json([
                'message' => 'login successfuly',
                'role'      => 'customer',
                'token'     => $token
            ], 200);
        }

        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function register(Request $request) {
        try {
             $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:users|max:255',
                'password'=> 'required'
            ], [
                'name.required' => 'email wajib diisi..',
                'email.required' => 'email wajib diisi..',
                'email.unique' => 'email sudah digunakan..',
                'password.required' => 'password wajib diisi....',
            ]);

        if ($validator->fails()) {
            return response()->json([
                'errors'=> $validator->errors()
            ], 422);
        }

        // Retrieve the validated input...
        $validated = $validator->validated();

        $validated['password'] = Hash::make($validated['password']);
        // membuat akun user
        $user = User::create([
            'name' =>  $validated['name'],
            'email' =>  $validated['email'],
            'password' =>  $validated['password'],
            'role' => 'customer'
        ]);

        // membuat token untuk user
        $token = $user->createToken('auth_token')->plainTextToken;

        // mengembalikan data user beserta token
        return response()->json([
            'message'=> 'Register Berhasil',
            'token' => $token,
        ],201);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'errors'=> $th->getMessage()
            ],500);
        }
    }

    public function logout(Request $request) {
        try {
            $request->user()->tokens()->delete();

          return response()->json(['message' => 'test'], 200);
        } catch (\Throwable $th) {
          return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function registerCustomer(Request $request) {
        try {
            // membuat rules validasi inputan untuk setiap fields
            $validator = Validator::make($request->all(), [
                'company_name'=> 'required|unique:customers|min:3',
                'email'=> 'required|unique:customers|min:3',
                'password'  => 'required',
                'contact_name' => 'required',
                'address'=> 'required',
                'city'=> 'required',
                'postal_code'=> 'required',
                'country'=> 'required',
                'phone'=> 'required',
            ],[
                'email.required'=> 'email pelanggan pelanggan wajib diisi..',
                'email.unique'=> 'email pelanggan sudah digunakan..',
                'password.required'=> 'password pelanggan wajib diisi..',
                'company_name.required'=> 'nama pelanggan pelanggan wajib diisi..',
                'company_name.unique'=> 'nama pelanggan sudah digunakan..',
                'company_name.min'=> 'nama pelanggan wajib lebih 3 karakter',
                'contact_name.required' => 'nama kontak pelanggan wajib diisi..',
                'address.required'=> 'alamat pelanggan wajib diisi..',
                'city.required'=> 'kontak pelanggan wajib diisi..',
                'postal_code.required'=> 'kode pos pelanggan wajib diisi..',
                'country.required'=> 'negara pelanggan wajib diisi..',
                'phone.required'=> 'nomor telepon pelanggan wajib diisi..',
            ]);
                // mengembalikan pesan error inputan user
            if($validator->fails()) {
                 return response()->json([
                'errors'=> $validator->errors()
                ], 422);
            }

            // mengambil inputan user yang berhasil validasi
            $validated = $validator->validated();

            // membuat akun customer
            $customer = Customer::create([
                'email'         => $validated['email'],
                'password'       => Hash::make($validated['password']),
                'company_name' => $validated['company_name'],
                'contact_name' => $validated['contact_name'],
                'address'       => $validated['address'],
                'city'          => $validated['city'],
                'postal_code'   => $validated['postal_code'],
                'country'       => $validated['country'],
                'phone'         => $validated['phone']
            ]);
            // membuat token customer
            $token = $customer->createToken('auth_token')->plainTextToken;

            // mengembalikan token user karna telah berhasil register
            return response()->json([
                'message'   => 'berhasil register',
                'customer'  => $customer,
                'token'     => $token
            ]);
        } catch (\Throwable $th) {

            return response()->json(['message'=> $th->getMessage()], 500);
        }
    }
}
