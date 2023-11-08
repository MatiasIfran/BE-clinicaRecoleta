<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\IndexRequest;

class UserController extends Controller
{

    public function allUsers(IndexRequest $request) {

        $users = User::all();
        $data = [
            'status'    => true,
            'users'     => $users,
        ];

        return response()->json($data, 200);
    }

    public function getUserById($userId) {

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    
        $data = [
            'status' => true,
            'user' => $user,
        ];
    
        return response()->json($data, 200);
    }
    
}
