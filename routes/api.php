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

Route::get('user/all', 'UserController@allUsers')->name('allUser');
Route::get('user/{userId}', 'UserController@getUserById')->name('user.getById');

Route::prefix('paciente')->group(function () {
    Route::get('/all', 'PacienteController@allPacientes')->name('allPacientes');
    Route::get('/{pacienteId}', 'PacienteController@getPacienteById')->name('getPacienteById');
    Route::get('/dni/{pacienteDni}', 'PacienteController@getPacienteByDni')->name('getPacienteByDni');
    Route::post('/createPaciente', 'PacienteController@createPaciente')->name('createPaciente');
});

Route::prefix('profesional')->group(function () {
    Route::get('/all', 'ProfesionalController@allProfesionales')->name('allProfesionales');
    Route::get('/{profesionalId}', 'ProfesionalController@getProfesionalById')->name('getProfesionalById');
    Route::get('/dni/{profesionalDni}', 'ProfesionalController@getProfesionalByDni')->name('getProfesionalByDni');
    Route::post('/createProfesional', 'ProfesionalController@createProfesional')->name('createProfesional');
});

Route::prefix('cp')->group(function () {
    Route::get('/all', 'CodigoPostalController@allCodigoPostal')->name('allCodigoPostal');
    Route::get('/{codigoPostalId}', 'CodigoPostalController@getCodPostById')->name('getCodPostById');
    Route::get('/codigo/{codigoPostalNumber}', 'CodigoPostalController@getCodPostByCodigo')->name('getCodPostByCodigo');
    Route::post('/createCodigoPostal', 'CodigoPostalController@createCodigoPostal')->name('createCodigoPostal');
});

Route::prefix('turno')->group(function () {
    Route::get('/all', 'TurnoController@allTurnos')->name('allTurnos');
    Route::get('/id/{turnoId}', 'TurnoController@getTurnoById')->name('getTurnoById');
    Route::get('/date', 'TurnoController@getTurnoByDate')->name('getTurnoByDate');
    Route::get('/datePaciente/{idPaciente}', 'TurnoController@getTurnoByPacienteId')->name('getTurnoByPaciente');
    Route::post('/createTurno', 'TurnoController@createTurno')->name('createTurno');
});

Route::prefix('horario')->group(function () {
    Route::get('/all', 'horarioController@allHorarios')->name('allHorarios');
    Route::get('/{horarioId}', 'horarioController@getHorarioById')->name('getHorarioById');
    Route::get('/date', 'horarioController@getHorarioByDate')->name('getHorarioByDate');
    Route::get('/dateprofesional/{idProfesional}', 'horarioController@getHorarioByProfesionalId')->name('getHorarioByProfesionalId');
    Route::post('/createHorario', 'horarioController@createHorario')->name('createHorario');
});

Route::prefix('obrasocial')->group(function () {
    Route::get('/all', 'ObraSocialController@allObrasSociales')->name('allObrasSociales');
    Route::get('/{obraSocialId}', 'ObraSocialController@getObraSocialById')->name('getObraSocialById');
    Route::get('/codigo/{obraSocialCodigo}', 'ObraSocialController@getObraSocialByCodigo')->name('getObraSocialByCodigo');
});

// Put