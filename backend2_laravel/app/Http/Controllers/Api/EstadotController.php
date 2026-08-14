<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estadot;

class EstadotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets=Estadot::with('fk_ticket')->get();
        return response()->json($tickets,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'id_ticket'=>'required|integer',
            'estado'=>'required|string',
            'fecha_estado_actual'=>'required|date_format:Y-m-d H:i:s',
            'descripcion_solucion'=>'required|string'
        ]);

        $new_estadot=Estadot::create($validated);

        return response()->json($new_estadot, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estado=Estadot::with('fk_ticket')->findOrFail($id);
        return response()->json($estado,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $estado=Estadot::findOrFail($id);

        $validated=$request->validate([
            'id_ticket'=>'required|integer',
            'estado'=>'required|string',
            'fecha_estado_actual'=>'required|date_format:Y-m-d H:i:s',
            'descripcion_solucion'=>'required|string'
        ]);

        $estado->update($validated);

        return response()->json($estado,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estado=Estadot::findOrFail($id);
        $estado->delete();
        return response()->json(["message"=>"Estado eliminado"],200);
    }
}
