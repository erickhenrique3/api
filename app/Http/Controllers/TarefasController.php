<?php

namespace App\Http\Controllers;

use App\Models\Tarefas;
use App\models\Subtarefas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TarefasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return response()->json(Tarefas::with("subtarefas")->paginate($request->input('per_page') ?? 15));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'due_date' => 'required|date_format:d/m/Y',
            'status' => 'required|string|in:pending,completed'
        ]);

        $due_date = Carbon::createFromFormat('d/m/Y', $request->input('due_date'));

        $tarefas = Tarefas::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' =>  $due_date,
            'status' => $request->input('status')

        ]);

        $tarefas->due_date = $tarefas->due_date->format('d/m/Y');

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
    public function show($id)
    {
        $tarefas = Tarefas::findOrFail($id);
        // $tarefas =Tarefas::with('subtarefas')->find($tarefas);
        return response()->json($tarefas);
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
    public function update(Request $request, Tarefas $tarefas, $id)
    {
        //
        $tarefas = Tarefas::findOrFail($id);


        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'nullable|string',
                'due_date' => 'nullable|date',
                'status' => 'nullable|string| in:pending,completed',

            ],

        );

        $tarefas->fill($request->all());
        $tarefas->save();


        // $tarefas->update($request->all());
        // $tarefas->refresh();

        return response()->json([
            'message' => 'tarefa atualizada com sucesso',
            'tarefa' => $tarefas
        ],);
    }

    public function patch(Request $request, $id)
    {
        $tarefas = Tarefas::findOrFail($id);

        $request->validate([
            'due_date' => 'required|date_format:d/m/Y'
        ]);
        $tarefas->due_date = Carbon::createFromFormat('d/m/Y', $request->input('due_date'));
        $tarefas->save();

        return response()->json([
            'message' => 'Due date atualizada com sucesso!',
            'tarefa' => $tarefas
        ], 200);
    }


    public function updateStatus(Request $request, $id)
    {
        $tarefas = Tarefas::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:pending,completed'
        ]);

        $tarefas->status = $request->input('status');
        $tarefas->save();

        return response()->json([
            'message' => 'Status da tarefa atualizado com sucesso!',
            'tarefa' => $tarefas
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefas $tarefas, $id)
    {
        // $tarefas->delete();
        $tarefas->where('id', $id)->delete();
        return response()->json(['message' => 'Tarefa excluida com sucesso!'], 200);
    }
}
