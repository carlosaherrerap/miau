<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets=Ticket::with(['fk_usuario','fk_categoria'])->get();
        return response()->json($tickets,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'cod_ticket'=>'required|string',
            'id_usuario'=>'required|integer',
            'fecha_emision'=>'required|date_format:Y-m-d H:i:s',
            'id_categoria'=>'required|integer',
            'descripcion_problema'=>'required|string',
            'nivel_importacia'=>'required|string'
        ]);

        $new_ticket=Ticket::create($validated);

        return response()->json($new_ticket,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket=Ticket::with(['fk_usuario','fk_categoria'])->findOrFail($id);
        return response()->json($ticket,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket=Ticket::findOrFail($id);

        $validated=$request->validate([
            'cod_ticket'=>'required|string',
            'id_usuario'=>'required|integer',
            'fecha_emision'=>'required|date_format:Y-m-d H:i:s',
            'id_categoria'=>'required|integer',
            'descripcion_problema'=>'required|string',
            'nivel_importacia'=>'required|string'
        ]);

        $ticket->update($validated);
        return response()->json($ticket,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket=Ticket::findOrFail($id);
        $ticket->delete();
        return response()->json(["message"=>"Ticket eliminado!"],200);
    }
}
