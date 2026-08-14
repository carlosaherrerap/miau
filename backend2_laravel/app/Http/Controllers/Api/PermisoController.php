<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permisosp;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permisos_publicacion=$request->validate([
            'id_publicacion'=>'required|integer',
            'id_usuario'=>'nullable|integer',
            'id_rol'=>'nullable|integer',
            'id_sedereg'=>'nullable|integer',
            'id_sedejuris'=>'nullable|integer',
            'estado'=>'required|integer'
        ]);

        $new_permiso=Permisosp::create($permisos_publicacion);
        return response()->json($new_permiso,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$permiso=Permisosp::with(['fk_publicacion','fk_usuario','fk_rol','fk_sedereg','fk_sedejuris'])->findOrFail($id);
        $permiso=Permisosp::findOrFail($id);
        
        $permiso_available=null;

        if(!is_null($permiso->id_usuario)){
            $permiso_available='fk_usuario';
        }elseif(!is_null($permiso->id_rol)){
            $permiso_available='fk_rol';
        }elseif (!is_null($permiso->id_sedereg)){
            $permiso_available='fk_sedereg';
        }elseif (!is_null($permiso->id_sedejuris)){
            $permiso_available='fk_sedejuris';
        }

        if($permiso_available){
            $permiso->load('fk_publicacion');
            $permiso->load($permiso_available);
        }

        return response()->json($permiso,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permiso=Permisosp::findOrFail($id);

        $permisos_publicacion=$request->validate([
            'id_publicacion'=>'required|integer',
            'id_usuario'=>'nullable|integer',
            'id_rol'=>'nullable|integer',
            'id_sedereg'=>'nullable|integer',
            'id_sedejuris'=>'nullable|integer',
            'estado'=>'required|integer'
        ]);

        $permiso->update($permisos_publicacion);

        return response()->json($permiso,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permiso=Permisosp::findOrFail($id);
        $permiso->delete();
        return response()->json(["message"=>'Se removió el permiso'],201);
    }
}
