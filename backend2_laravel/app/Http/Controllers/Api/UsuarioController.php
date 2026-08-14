<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios=Usuario::with(['fk_rol','fk_sedereg','fk_sedejuris'])->get();
        return response()->json($usuarios,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'id_rol'=>'required|integer',
            'cod_usuario'=>'required|string',
            'username'=>'required|string|min:3|max:20',
            'clave'=>'required|string|min:3|max:50',
            'nombres'=>'required|string|min:3|max:25',
            'ape_pat'=>'required|string|min:3|max:25',
            'ape_mat'=>'string',
            'id_sedereg'=>'required|integer',
            'id_sedejuris'=>'required|integer',
            'doc'=>'required|integer',
            'email'=>'string|min:5|max:40',
            'estado'=>'required|integer'
        ],
        [
            'username.min'=>'Debes ingresar un nombre más largo de 3 caracteres',
            'username.required'=>'Ingresa un nombre de Usuario',
            'clave.required'=>'Por favor, ingresa una contraseña',
            'clave.min'=>'Por favor, ingresa una contraseña más segura y larga',
            'doc.required'=>'Es importante que registres un número de documento',
            'doc.min'=>'El número de documento ingresado no es correcto',
            'rol.required'=>'Se requiere rol:0 para emitir ticket y rol:1 para administrador'
        ]);

        $validated['clave'] = Hash::make($validated['clave']);


        $new_usuario=Usuario::create($validated);
        return response()->json($new_usuario,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario=Usuario::findOrFail($id);
        return response()->json($usuario,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario=Usuario::findOrFail($id);
        
        $validated=$request->validate([
            'id_rol'=>'required|integer',
            'cod_usuario'=>'required|string',
            'username'=>'required|string|min:3|max:20',
            'clave'=>'required|string|min:3|max:50',
            'nombres'=>'required|string|min:3|max:25',
            'ape_pat'=>'required|string|min:3|max:25',
            'ape_mat'=>'string',
            'id_sedereg'=>'required|integer',
            'id_sedejuris'=>'required|integer',
            'doc'=>'required|integer',
            'email'=>'string|min:5|max:40',
            'estado'=>'required|integer'
        ]);
        
        $usuario->update($validated);

        return response()->json($usuario,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario=Usuario::findOrFail($id);
        $usuario->delete();
        return response()->json($usuario,200);
    }
}
