<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria=Categoria::All();
        return response()->json($categoria,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'nombre'=>'required|string',
            'tipo'=>'required|string'
        ]);

        $new_categoria=Categoria::create($validated);

        return response()->json($new_categoria,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria=Categoria::findOrFail($id);
        return response()->json($categoria,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoria=Categoria::findOrFail($id);

        $validated=$request->validate([
            'nombre'=>'required|string',
            'tipo'=>'required|string'
        ]);

        $categoria->update($validated);

        return response()->json($categoria,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->delete();
        return response()->json(["message"=>"Categoria removida"],200);
    }
}
