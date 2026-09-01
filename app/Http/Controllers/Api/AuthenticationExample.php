<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, Validator, DB};
use Illuminate\Validation\Rules;

class AuthenticationExample extends Controller
{
    public function register(Request $request) {
        try {
             $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            ], [
                'name.required'=> 'nama wajib disi..',
                'email.required' => 'email wajib disi..', 
                'email.unique' => 'email sudah dipakai..', 
                'password.required' => 'password wajib disi..',
            ]);

            if ($validator->fails()) {
                    return response()->json([
                    'message'   => $validator->errors()
                ], 422);
            }

             $validated = $validator->validated();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password'  => Hash::make($validated['password']),
                'role'  => 'user'
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message'   => 'register berhasil',
                'token'     => $token,
                'token_type' => 'Bearer',
                'user'  =>  $user->makeHidden(['created_at', 'updated_at'])
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message'   => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request) {
        try {
             $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'password' => ['required', 'string'],
            ], [
                'email.required' => 'email wajib disi..', 
                'password.required' => 'password wajib disi..',
            ]);

            if ($validator->fails()) {
                    return response()->json([
                    'message'   => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();
            // megambil data user
            $user = User::where('email', $validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'message' => 'Email atau password salah',
                ], 401);
            }

            // membuat token
            $token = $user->createToken('auth_token')->plainTextToken;


            return response()->json([
            'message' => 'login berhasil.',
            'token'     => $token,
            'token_type'    => 'Bearer',
            'user'      =>  $user->makeHidden(['created_at', 'updated_at'])
        ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message'   => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request) {
       $request->user()->tokens()->delete();

         return response()->json([
            'message' => 'Successfully logged out.'
        ], 200);
    }
}
