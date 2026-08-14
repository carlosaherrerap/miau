<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AsignacionController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\EstadotController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\PermisoController;
use App\Http\Controllers\Api\PublicacionController;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\SedejController;
use App\Http\Controllers\Api\SederController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\VistapController;


Route::apiResource('asignacion',AsignacionController::class);
Route::apiResource('categoria', CategoriaController::class);
Route::apiResource('estadot',EstadotController::class);
Route::apiResource('file',FileController::class);
Route::apiResource('permiso',PermisoController::class);
Route::apiResource('publicacion',PublicacionController::class);
Route::apiResource('rol',RolController::class);
Route::apiResource('sedej',SedejController::class);
Route::apiResource('seder',SederController::class);
Route::apiResource('ticket',TicketController::class);
Route::apiResource('usuario',UsuarioController::class);
Route::apiResource('vista',VistapController::class);