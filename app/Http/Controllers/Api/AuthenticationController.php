<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{Validator, Hash};

class AuthenticationController extends Controller
{
    public function login() {}

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

    public function logout() {}
}
