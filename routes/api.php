<?php

use App\Http\Controllers\MotoController;
use App\Http\Controllers\SubtasksController;
use App\Http\Controllers\TasksController;
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

Route::prefix('tasks')->controller(TasksController::class)->group(function () {
    Route::post('/', 'create');
    Route::get('/', 'index');
    Route::get('/{tasks}', 'show');
    Route::put('/{tasks}', 'update');
    Route::patch('/{tasks}/due_date', 'patch');
    Route::patch('/{tasks}/status', 'updateStatus');
    Route::delete('/{tasks}', 'destroy');
    Route::get('/filter/today', 'filterToday'); 
    Route::get('/filter/overdue', 'filterOverdue');
});

Route::prefix('subtasks')->controller(SubtasksController::class)->group(function () {
    Route::post('/', 'create');
    Route::get('/', 'index');
    Route::get('/{subtasks}', 'show');
    Route::put('/{id}', 'update');
    Route::patch('/{id}', 'updateStatus');
    Route::delete('/{subtasks}', 'destroy');
});
