<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthentificationController extends Controller
{
   function login(Request $request){
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password harus diisi.',
    ]);
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : null;
        return response()->json([
            'status' => 'success',
            'data' => [
                'token' => $token,
                "user"=> [
                            "id" => $user->id,
                            "name" => $user->name,
                            "email" => $user->email,
                            "avatar" => $avatarUrl 
                        ]],
        ], 200);
    }
    return response()->json([
        'status' => 'error',
        'message' => 'Email atau password salah',
    ], 401);
   }
   
   function register(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'avatar' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string|max:100',
        'nomor_telp' => 'required|string|max:100',
    ]);
        if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation error',
            'errors' => $validator->errors()
        ], 422);
    }        
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'tanggal_lahir' => $request->tanggal_lahir,
        'alamat' => $request->alamat,
        'nomor_telp' => $request->nomor_telp,
    ]);
    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $avatarPath = $avatar->store('avatars', 'public');
        $user->avatar = $avatarPath;
        $user->save();
    }
    return response()->json(['message' => 'User registered successfully'], 201);
   }

   function logout(Request $request){
    $request->user()->currentAccessToken()->delete();
    return response()->json(["status" => "success", "message" => "berhasil logout"], 200);
    }
    function me(Request $request) {
        $user = Auth::user();
        return response()->json($user, 200);
    }
}
