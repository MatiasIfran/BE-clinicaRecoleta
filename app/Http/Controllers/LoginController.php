<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //Se encargara de recibir la request del usuario para loguearse

    public function authenticate(Request $request) {

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {

            $token = Auth::user()->createToken(Auth::id())->plainTextToken;

            return response()->json([
                'token' => $token
            ]);

        } else {

            return response()->json([
                'error' => 'Credenciales incorrectas. Por favor, inténtalo de nuevo.'
            ], 400);
        }
    }
}
