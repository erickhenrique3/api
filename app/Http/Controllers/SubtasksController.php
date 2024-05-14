<?php

namespace App\Http\Controllers;

use App\Models\Subtasks;
use App\Models\Tasks;
use Illuminate\Http\Request;

class SubtasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return response()->json(Subtasks::get());
    }

    public function create(Request $request)
    {
        $status = $request->input('status', 'pending');

        $subtarefas = Subtasks::create([
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
        $subtarefas = Subtasks::findOrFail($id);
        return response()->json($subtarefas);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subtasks $subtarefas, $id)
    {
        $request->validate(
            [
                'title' => 'string',
                'description' => 'nullable|string',
                'task_id' => 'numeric',
                'status' => 'nullable|string| in:pending,completed',

            ],
        );


        
        $subtarefa = Subtasks::findOrFail($id);
        $subtarefa->update($request->all());

        return response()->json([
            'message' => 'subtarefa atualizada com sucesso',
            'subtarefa' => $subtarefa
        ],);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subtasks $subtarefas, $id)
    {
        //
        $subtarefas = Subtasks::findOrFail($id);
        $subtarefas->delete();
        return response()->json(['message' => 'Subtarefa excluida com sucesso!'], 200);
    }
}
