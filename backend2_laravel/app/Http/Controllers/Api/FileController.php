<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'id_ticket'=>'required|integer',
            'id_publicacion'=>'required|integer',
            'tipo'=>'required|string',
            'enlace'=>'required|string'
        ]);

        $new_file=File::create($validated);
        return response()->json($new_file,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file=File::with(['fk_ticket','fk_publicacion'])->findOrFail($id);
        return response()->json($file,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $file=File::findOrFail($id);
        $validated=$request->validate([
            'id_ticket'=>'required|integer',
            'id_publicacion'=>'required|integer',
            'tipo'=>'required|string',
            'enlace'=>'required|string'
        ]);

        $file->update($validated);
        return response()->json($file,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file=File::findOrFail($id);
        $file->delete();
        return response()->json(["message"=>"Archivo destruido"],200);
    }
}
