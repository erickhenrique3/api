<?php

namespace App\Http\Controllers;

use App\Models\Subtarefas;
use Illuminate\Http\Request;

class SubtarefasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return response()->json(Subtarefas::paginate($request->input('per_page') ?? 15));
    
    }

    public function create(Request $request)
    {
        //
        $subtarefas = Subtarefas::create([
            'title' => $request->input('title'),
            // 'tarefa_id' => $request->input('tarefa_id'),
            'description' => $request->input('description'),
            'status' => $request->input('status')

        ]);

        return response()->json([
            'message' => 'subtarefa adicionada!',
            'subtarefas' => $subtarefas

        ]);
    }

    public function show(Subtarefas $subtarefas)
    {
        return response()->json(($subtarefas));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subtarefas $subtarefas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subtarefas $subtarefas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subtarefas $subtarefas)
    {
        //
        $subtarefas->delete();
        return response()->json(['message' => 'Subtarefa excluida com sucesso!'], 200);
    }
}
