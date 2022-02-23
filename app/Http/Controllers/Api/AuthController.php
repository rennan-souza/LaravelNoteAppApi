<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        $request['password'] = Hash::make($request['password']);
        return User::create($request->all());
    }

    public function login(Request $request)
    {

        $token = Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ]);

        if (!$token) {
            return response()->json(['errors' => 'Email e ou senha inválidos.'], 422);
        }

        return response(['token' => $token], 200);
    }

    public function unauthorized()
    {
        return response()->json(['errors' => 'Acesso negado.'], 401);
    }
}
