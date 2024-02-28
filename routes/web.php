<?php

use App\Http\Controllers\MateriasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MateriasController::class, 'index']);
Route::get('/materias/create', [MateriasController::class, 'create']);
Route::get('/materias/{id}', [MateriasController::class, 'materia']);
Route::post('/materias', [MateriasController::class, 'store']);
