<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicacion;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicaciones=Publicacion::All();
        return response()->json($publicaciones,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'nombre'=>'required|string',
            'version'=>'required|decimal',
            'fecha_publicacion'=>'required|date_format:Y-m-d H:i:s',
            'fecha_vigencia'=>'required|date_format:Y-m-d H:i:s',
            'indicaciones'=>'required|string'
        ]);

        $new_publicacion=Publicacion::create($validated);
        return response()->json($new_publicacion,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publicacion=Publicacion::findOrFail($id);
        return response()->json($publicacion,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $publicacion=Publicacion::findOrFail($id);
        $validated=$request->validate([
            'nombre'=>'required|string',
            'version'=>'required|decimal',
            'fecha_publicacion'=>'required|date_format:Y-m-d H:i:s',
            'fecha_vigencia'=>'required|date_format:Y-m-d H:i:s',
            'indicaciones'=>'required|string'
        ]);

        $publicacion->update($validated);

        return response()->json($publicacion,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publicacion=Publicacion::findOrFail($id);
        $publicacion->delete();
        return response()->json($publicacion,200);
    }
}
