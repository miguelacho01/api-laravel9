<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $this->validateLogin($request);
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'tolen' => $request->user()->createToken($request->name)->plainTextToken,
            ]);
        }
        return response()->json([
            'message' => 'no esta autorizado'
        ]);
    }

    public function validateLogin(Request $request)
    {
        return $request->validate([
            'email' => 'required|eamil',
            'password' => 'required',
            'name' => 'required'
        ]);
    }
}
