<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//Rutas disponibles

//  Post
Route::post('login', 'LoginController@authenticate');
Route::post('user/create', 'UserController@createUser')->name("createUser");
Route::post('persona/create', 'PersonaController@createPersona')->name('createPersona');

//  Get
Route::get('user/allUsers', 'UserController@allUsers')->name('user');
Route::get('user/user/{userId}', 'UserController@getUserById')->name('user.getById');
Route::get('user/index', 'UserController@index')->name('user.getById');
Route::get('persona/allPersonas', 'PersonaController@allPersonas')->name('allPersonas');
