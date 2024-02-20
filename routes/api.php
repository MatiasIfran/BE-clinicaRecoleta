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

//  Post
Route::post('login', 'LoginController@authenticate');

Route::prefix('user')->group(function () {
    Route::get('/all', 'UserController@allUsers')->name('allUser');
    Route::get('/{userId}', 'UserController@getUserById')->name('user.getById');
    Route::post('/createUser', 'UserController@createUser')->name("createUser");
});

Route::prefix('paciente')->group(function () {
    Route::get('/all', 'PacienteController@allPacientes')->name('allPacientes');
    Route::get('/searchPaciente', 'PacienteController@searchPaciente')->name('searchPaciente');
    Route::get('/{pacienteId}', 'PacienteController@getPacienteById')->name('getPacienteById');
    Route::get('/dni/{pacienteDni}', 'PacienteController@getPacienteByDni')->name('getPacienteByDni');
    Route::get('input/getPacienteByName', 'PacienteController@getPacienteByNombreApellido')->name('getPacienteByNombreApellido');
    Route::post('/createPaciente', 'PacienteController@createPaciente')->name('createPaciente');
    Route::put('/update/{pacienteDni}', 'PacienteController@updatePaciente')->name('updatePaciente');
});

Route::prefix('profesional')->group(function () {
    Route::get('/all', 'ProfesionalController@allProfesionales')->name('allProfesionales');
    Route::get('/allActivos', 'ProfesionalController@allProfesionalesActivos')->name('allProfesionalesActivos');
    Route::get('/{profesionalId}', 'ProfesionalController@getProfesionalById')->name('getProfesionalById');
    Route::get('/dni/{profesionalDni}', 'ProfesionalController@getProfesionalByDni')->name('getProfesionalByDni');
    Route::post('/createProfesional', 'ProfesionalController@createProfesional')->name('createProfesional');
    Route::put('/update/{profesionalId}', 'ProfesionalController@updateProfesional')->name('updateProfesional');
});

Route::prefix('cp')->group(function () {
    Route::get('/all', 'CodigoPostalController@allCodigoPostal')->name('allCodigoPostal');
    Route::get('/{codigoPostalId}', 'CodigoPostalController@getCodPostById')->name('getCodPostById');
    Route::get('/codigo/{codigoPostalNumber}', 'CodigoPostalController@getCodPostByCodigo')->name('getCodPostByCodigo');
    Route::post('/createCodigoPostal', 'CodigoPostalController@createCodigoPostal')->name('createCodigoPostal');
});

Route::prefix('turno')->group(function () {
    Route::get('/all', 'TurnoController@allTurnos')->name('allTurnos');
    Route::get('/date', 'TurnoController@getTurnoByDate')->name('getTurnoByDate');
    Route::get('/{turnoId}', 'TurnoController@getTurnoById')->name('getTurnoById');
    Route::get('/datePaciente/{idPaciente}', 'TurnoController@getTurnoByPaciente')->name('getTurnoByPaciente');
    Route::get('/libre/turnosDisponible', 'TurnoController@getTurnosDisponibles')->name('getTurnosDisponibles');
    Route::post('/createTurno', 'TurnoController@createTurno')->name('createTurno');
    Route::delete('/deleteTurno/{turnoId}', 'TurnoController@deleteTurno')->name('deleteTurno');
    Route::put('/update/{turnoId}', 'TurnoController@updateTurno')->name('updateTurno');
});

Route::prefix('horario')->group(function () {
    Route::get('/all', 'HorarioController@allHorarios')->name('allHorarios');
    Route::get('/nameDay', 'HorarioController@getHorarioByNameDay')->name('getHorarioByNameDay');
    Route::get('/{horarioId}', 'HorarioController@getHorarioById')->name('getHorarioById');
    Route::get('/dateProfesional/{prof_cod}', 'HorarioController@getHorarioByProfesionalCodigo')->name('getHorarioByProfesionalCodigo');
    Route::post('/createHorario', 'HorarioController@createHorario')->name('createHorario');
    Route::delete('/deleteHorario/{horarioId}', 'HorarioController@deleteHorario')->name('deleteHorario');
    Route::put('/update/{horarioId}', 'HorarioController@updateHorario')->name('updateHorario');
    Route::put('/updateAll', 'HorarioController@updateAllHorario')->name('updateAllHorario');
});

Route::prefix('obrasocial')->group(function () {
    Route::get('/all', 'ObraSocialController@allObrasSociales')->name('allObrasSociales');
    Route::get('/{obraSocialId}', 'ObraSocialController@getObraSocialById')->name('getObraSocialById');
    Route::get('/codigo/{obraSocialCodigo}', 'ObraSocialController@getObraSocialByCodigo')->name('getObraSocialByCodigo');
});

Route::prefix('feriado')->group(function () {
    Route::get('/all', 'FeriadoController@allFeriados')->name('allFeriados');
    Route::get('/{feriadoId}', 'FeriadoController@getFeriadoById')->name('getFeriadoById');
    Route::post('/createFeriado', 'FeriadoController@createFeriado')->name('createFeriado');
});

Route::prefix('historiaclinica')->group(function () {
    Route::get('/all', 'HistoriaClinicaController@allHistoriaClinica');
    Route::get('/profesional/{prof_cod}', 'HistoriaClinicaController@getHistoriaClinicaByProfesionalCodigo');
    Route::get('/paciente/{pacienteId}', 'HistoriaClinicaController@getHistoriaClinicaByPacienteId');
    Route::post('/create', 'HistoriaClinicaController@createHistoriaClinica');
    Route::delete('/delete/{historiaClinicaId}', 'HistoriaClinicaController@deleteHistoriaClinica');
});

// Put