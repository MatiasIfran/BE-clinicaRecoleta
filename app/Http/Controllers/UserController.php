<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\IndexRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth:sanctum');
    }

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
    
    public function index(IndexRequest $request) {
        return UserResource::collection(User::all());
    }
}
