<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return response()->json(Moto::paginate($request->input('per_page') ?? 15));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


        $moto = Moto::create([
          'name' => $request->input('name'),
          'amount' => $request->input('amount'),
          'description' => $request->input('description')
        ]);

        return response()->json([
            'message' => 'moto adicionada!',
            'moto' => $moto

        ]);
        //
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
    public function show(Moto $moto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Moto $moto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Moto $moto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moto $moto)
    {
        //
    }
}
