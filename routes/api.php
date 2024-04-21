<?php

use App\Http\Controllers\MotoController;
use App\Http\Controllers\TarefasController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('Tarefas')->controller(TarefasController::class)->group(function () {
    Route::post('/', 'create');
    Route::get('/', 'index');
    Route::get('/{tarefas}', 'show');
    Route::put('/{tarefas}', 'update');
    Route::delete('/{tarefas}', 'destroy');
});
