<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\User\CreateUserRequest;
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
            $data = [
                'status'    => false,
                'error' => 'Usuario no encontrado',
            ];
    
            return response()->json($data, 404);
        }
    
        $data = [
            'status' => true,
            'user' => $user,
        ];
    
        return response()->json($data, 200);
    }

    public function createUser(CreateUserRequest $request) {

        $user = new User;

        $user = $user->createUserModel($request);

        return response()->json([
            'status'   =>  true,
            'user'  => new UserResource($user)
        ], 200);
    }
    
    public function index(IndexRequest $request) {
        return UserResource::collection(User::all());
    }
}
