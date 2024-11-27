<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);
        $user->fill($validated);
        if ($user->save()) {
            return response()->json(['message' => 'User created successfully'], 201);
        } else {
            return response()->json(['message' => 'Error creating user'], 500);
        }
    }

    function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['message' => 'Login successful'], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logout successful'], 200);
    }

    function csrf(Request $request)
    {
        $csrf = $request->session()->token();
        $csrf = csrf_token();
        return response()->json(['csrf' => $csrf], 200);
    }
}
