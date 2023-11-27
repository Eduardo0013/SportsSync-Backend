<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DeporteController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\TorneoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::post('/auth/create','create');
    Route::post('/auth/login','login');
    Route::patch('/auth/update','update');
});
Route::apiResource('/deportes',DeporteController::class);
Route::apiResource('/torneos',TorneoController::class);
Route::apiResource('/deportes',DeporteController::class);
Route::apiResource('/categorias',CategoriaController::class);
Route::apiResource('/equipos',EquipoController::class);