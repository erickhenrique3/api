<?php

namespace App\Http\Controllers;

use App\Models\Subtarefas;
use App\Models\Tarefas;
use Illuminate\Http\Request;

class SubtarefasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return response()->json(Subtarefas::get());
    }

    public function create(Request $request)
    {
        $status = $request->input('status', 'pending');

        $subtarefas = Subtarefas::create([
            'title' => $request->input('title'),
            'task_id' => $request->input('task_id'),
            'description' => $request->input('description'),
            'status' => $status

        ]);

        return response()->json([
            'message' => 'subtarefa adicionada!',
            'subtarefas' => $subtarefas

        ]);
    }

    public function show($id)
    {
        $subtarefas = Subtarefas::findOrFail($id);
        return response()->json($subtarefas);
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
    public function update(Request $request, Subtarefas $subtarefas, $id)
    {
        $request->validate(
            [
                'title' => 'string',
                'description' => 'nullable|string',
                'task_id' => 'numeric',
                'status' => 'nullable|string| in:pending,completed',

            ],
        );


        
        $subtarefa = Subtarefas::findOrFail($id);
        $subtarefa->update($request->all());

        return response()->json([
            'message' => 'subtarefa atualizada com sucesso',
            'subtarefa' => $subtarefa
        ],);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subtarefas $subtarefas, $id)
    {
        //
        $subtarefas = Subtarefas::findOrFail($id);
        $subtarefas->delete();
        return response()->json(['message' => 'Subtarefa excluida com sucesso!'], 200);
    }
}
