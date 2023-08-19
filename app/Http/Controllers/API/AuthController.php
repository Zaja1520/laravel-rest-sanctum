<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $field = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required','string','min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $field['name'],
            'email' => $field['email'],
            'password' => bcrypt($field['password']),
        ]);

        $response = [
            'message' => 'success',
            'token' => $user->createToken('authToken')->plainTextToken,
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        $field = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required','string','min:8'],
        ]);

        $user = User::where('email', $field['email'])->first();

        if (!$user || !Hash::check($field['password'], $user->password))
        {
            $response = [
              'message' => 'invalid credentials',
            ];

            return response()->json($response, 401);
        }

        $response = [
            'user' => $user,
            'message' => 'success',
            'token' => $user->createToken('authToken')->plainTextToken,
        ];

        return response()->json($response, 201);
    }

    public function logout(Request $request)
    {  
        // delete token from user
        auth()->user()->tokens()->delete(); 
        // display logout message
        return [
            'message' => 'logged out',
        ];
    }

}
