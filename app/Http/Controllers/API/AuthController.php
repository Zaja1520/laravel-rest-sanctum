<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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

    public function login()
    {

    }
}
