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
Route::post('user/createUser', 'UserController@createUser')->name("createUser");
Route::post('persona/createPersona', 'PersonaController@createPersona')->name('createPersona');
Route::post('paciente/createPaciente', 'PacienteController@createPaciente')->name('createPaciente');
Route::post('profesional/createProfesional', 'ProfesionalController@createProfesional')->name('createProfesional');

//  Get
Route::get('user/all', 'UserController@allUsers')->name('allUser');
Route::get('user/{userId}', 'UserController@getUserById')->name('user.getById');

Route::get('persona/all', 'PersonaController@allPersonas')->name('allPersonas');
Route::get('persona/{personaId}', 'PersonaController@getPersonaById')->name('persona.getPersonaById');
Route::get('personaDni/{personaDni}', 'PersonaController@getPersonaByDni')->name('persona.getPersonaByDni');

Route::get('paciente/all', 'PacienteController@allPacientes')->name('allPacientes');
Route::get('paciente/{pacienteId}', 'PacienteController@getPacienteById')->name('getPacienteById');
Route::get('pacienteDni/{pacienteDni}', 'PacienteController@getPacienteByDni')->name('getPacienteByDni');

Route::get('profesional/all', 'ProfesionalController@allProfesionales')->name('allProfesionales');
Route::get('profesional/{profesionalId}', 'ProfesionalController@getProfesionalById')->name('getProfesionalById');
Route::get('profesionalDni/{profesionalDni}', 'ProfesionalController@getProfesionalByDni')->name('getProfesionalByDni');

Route::get('cp/all', 'CodigoPostalController@allCodigoPostal')->name('allCodigoPostal');
Route::get('cp/id/{codigoPostalId}', 'CodigoPostalController@getCodPostById')->name('getCodPostById');
Route::get('cp/{codigoPostalNumber}', 'CodigoPostalController@getCodPostByCodigo')->name('getCodPostByCodigo');

// Put