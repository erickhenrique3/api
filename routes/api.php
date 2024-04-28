<?php

use App\Http\Controllers\MotoController;
use App\Http\Controllers\SubtarefasController;
use App\Http\Controllers\TarefasController;
use App\Models\Subtarefas;
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

Route::prefix('tasks')->controller(TarefasController::class)->group(function () {
    Route::post('/', 'create');
    Route::get('/', 'index');
    Route::get('/{tasks}', 'show');
    Route::put('/{tasks}', 'update');
    Route::patch('/{task}/due-date', 'patch');
    Route::delete('/{tasks}', 'destroy');
});

Route::prefix('subtasks')->controller(SubtarefasController::class)->group(function (){
    Route::post('/', 'create');
    Route::get('/', 'index');
    Route::get('/{subtasks}', 'show');
    Route::put('/{subtasks}', 'update');
    Route::delete('/{subtasks}', 'destroy');
});
