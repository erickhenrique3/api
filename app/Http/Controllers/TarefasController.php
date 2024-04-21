<?php

namespace App\Http\Controllers;

use App\Models\Tarefas;
use Illuminate\Http\Request;

class TarefasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return response()->json(Tarefas::paginate($request->input('per_page') ?? 15));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $tarefas = Tarefas::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'status' => $request->input('status')

        ]);

        return response()->json([
            'message' => 'tarefa adicionada!',
            'tarefa' => $tarefas

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefas $tarefas)
    {
        return response()->json(($tarefas));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefas $tarefas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefas $tarefas)
    {
        //
        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'nullable|string',
                'due_date' => 'nullable|date',
                'status' => 'nullable|string| in:pending,completed',

            ],

        );




        $tarefas->update($request->all());

        return response()->json([
            'message' => 'tarefa atualizada com sucesso',
            'tarefa' => $tarefas
        ], );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefas $tarefas)
    {
        $tarefas->delete();
        return response()->json(['message' => 'Tarefa excluida com sucesso!'], 200);
    }
}
