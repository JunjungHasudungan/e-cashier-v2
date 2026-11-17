<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Customer};
use Illuminate\Support\Facades\{Validator, Hash};
use Illuminate\Validation\Rules;

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

    public function logout(Request $request) {
        try {
            $request->user()->tokens()->delete();

          return response()->json(['message' => 'test'], 200);
        } catch (\Throwable $th) {
          return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function register(Request $request) {
        try {
            // membuat rules validasi inputan untuk setiap fields
            $validator = Validator::make($request->all(), [
                // rule untuk user
                'name' => ['required', 'string', 'max:255'],
                'role'         => 'required|in:user,customer',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'string'],

                // rule untuk customer
                'company_name'=> 'required_if:role,customer|unique:customers|min:3',
                'contact_name' => 'required_if:role,customer',
                'address'      => 'required_if:role,customer',
                'city'         => 'required_if:role,customer',
                'postal_code'  => 'required_if:role,customer',
                'country'      => 'required_if:role,customer',
                'phone'        => 'required_if:role,customer',
            ],[
                // pesan error bila role user
                'name.required' => 'email wajib diisi..',
                'role.required' => 'role wajib diisi..',
                'email.required'=> 'email pelanggan pelanggan wajib diisi..',
                'email.unique'=> 'email pelanggan sudah digunakan..',
                'password.required'=> 'password pelanggan wajib diisi..',
                'company_name.required_if'=> 'nama pelanggan pelanggan wajib diisi..',
                'company_name.unique'=> 'nama pelanggan sudah digunakan..',
                'company_name.min'=> 'nama pelanggan wajib lebih 3 karakter',
                'contact_name.required_if' => 'nama kontak pelanggan wajib diisi..',
                'address.required_if'=> 'alamat pelanggan wajib diisi..',
                'city.required_if'=> 'kontak pelanggan wajib diisi..',
                'postal_code.required_if'=> 'kode pos pelanggan wajib diisi..',
                'country.required_if'=> 'negara pelanggan wajib diisi..',
                'phone.required_if'=> 'nomor telepon pelanggan wajib diisi..',
            ]);
                // mengembalikan pesan error inputan user
            if($validator->fails()) {
                 return response()->json([
                'errors'=> $validator->errors()
                ], 422);
            }

            // mengambil inputan user yang berhasil validasi
            $validated = $validator->validated();

            // membuat akun role: user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role']
            ]);

            // membuat akun role:customer
            if($validated['role'] == 'customer') {
                $customer = Customer::create([
                    'company_name' => $validated['company_name'],
                    'contact_name' => $validated['contact_name'],
                    'address'       => $validated['address'],
                    'city'          => $validated['city'],
                    'postal_code'   => $validated['postal_code'],
                    'country'       => $validated['country'],
                    'phone'         => $validated['phone'],
                    'user_id'       => $user->id
                ]);

                // membuat token user
                $token = $user->createToken('auth_token')->plainTextToken;
                
                return response()->json([
                    'message'   => 'berhasil register',
                    'customer'  => $customer,
                    'token'     => $token
                ]);
            }
            // membuat token user
             $token = $user->createToken('auth_token')->plainTextToken;

            // mengembalikan token user karna telah berhasil register
            return response()->json([
                'message'   => 'berhasil register',
                'token'     => $token
            ]);
        } catch (\Throwable $th) {

            return response()->json(['message'=> $th->getMessage()], 500);
        }
    }
}
