<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vistap;

class VistapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vista=Vistap::with(['id_usuario','id_publicacion']);
        return response()->json($vista,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'id_usuario'=>'required|integer',
            'id_publicacion'=>'required|integer',
            'fecha_vista'=>'required|date_format: Y-m-d H:i:s'
        ]);

        $newVista=Vistap::create($validated);
        return response()->json($validated,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vista=Vistap::findOrFail($id);
        return response()->json($vista,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vista=Vistap::findOrFail($id);
        $validated=$request->validate([
            'id_usuario'=>'required|integer',
            'id_publicacion'=>'required|integer',
            'fecha_vista'=>'required|date_format: Y-m-d H:i:s'
        ]);

        $vista->update($validated);
        return response()->json($vista,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vista=Vistap::findOrFail($id);
        $vista->delete();
        return response()->json($vista,200);
    }
}
