<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rol=Rol::All();
        return response()->json($rol,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'cod'=>'required|string',
            'nombre'=>'required|string'
        ]);

        $new_rol=Rol::create($validated);

        return response()->json($new_rol,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rol=Rol::findOrFail($id);
        return response()->json($rol,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rol=Rol::findOrFail($id);
        $validated=$request->validate([
            'cod'=>'required|string',
            'nombre'=>'required|string'
        ]);

        $rol->update($validated);

        return response()->json($rol,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol=Rol::findOrFail($id);
        $rol->delete();
        return response()->json($rol,200);
    }
}
