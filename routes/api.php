<?php

use App\Http\Controllers\MotoController;
use App\Http\Controllers\SubtasksController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use App\Models\Subtarefas;
use App\Models\Subtasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;




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

// Route::middleware('api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('api')->group(function () {
    // esse resource faz:
    //Por exemplo, ao usar Route::resource('users', UserController::class), o Laravel irá gerar as seguintes rotas automaticamente:

    // GET /users - Retorna todos os usuários.
    // POST /users - Armazena um novo usuário.
    // GET /users/{user} - Retorna os detalhes de um usuário específico.
    // PUT/PATCH /users/{user} - Atualiza os detalhes de um usuário específico.
    // DELETE /users/{user} - Exclui um usuário específico.
    Route::resource('user', UsersController::class);
});



Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);

    if (!$token = JWTAuth::attempt($credentials)) {
        abort(401, 'unauthorized');
    }
    return  response()->json([
        'data' => [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]


    ]);
});

Route::prefix('tasks')->group(function () {
    Route::controller(TasksController::class)->group(function () {
        Route::post('/', 'create');
        Route::get('/', 'index');
        Route::get('/{tasks}', 'show');
        Route::put('/{tasks}', 'update');
        Route::patch('/{tasks}/due_date', 'patch');
        Route::patch('/{tasks}/status', 'updateStatus');
        Route::delete('/{tasks}', 'destroy');
        Route::get('/filter/today', 'filterToday');
        Route::get('/filter/overdue', 'filterOverdue');


        Route::prefix('subtasks')->group(function () {
            Route::post('/', [SubtasksController::class, 'create']);
            Route::get('/', [SubtasksController::class, 'index']);
            Route::get('/{subtasks}', [SubtasksController::class, 'show']);
            Route::put('/{id}', [SubtasksController::class, 'update']);
            Route::patch('/{id}', [SubtasksController::class, 'updateStatus']);
            Route::delete('/{subtasks}', [SubtasksController::class, 'destroy']);
        });
    });
});
