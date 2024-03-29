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
Route::post('/materias/store', [MateriasController::class, 'store']);

Route::get('/materias/edit/{id}', [MateriasController::class, 'edit']);
Route::post('/materias/update', [MateriasController::class, 'update']);

Route::get('/materias/delete/{id}', [MateriasController::class, 'delete']);
Route::get('/materias/{id}', [MateriasController::class, 'materia']);

Route::get('/user/dash', [MateriasController::class, 'materiasByUser']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
