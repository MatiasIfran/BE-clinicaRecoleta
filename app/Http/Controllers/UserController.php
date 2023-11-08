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
}
