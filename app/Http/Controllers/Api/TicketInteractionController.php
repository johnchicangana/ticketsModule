<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TicketInteraction;
use Illuminate\Http\Request;

class TicketInteractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = TicketInteraction::orderby('id','asc')->paginate(10);
        return response()->json([
            "message" => 'List of Tickets',
            "data" => $list	
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                "ticket_id" => ['required', 'integer'],
                "interaction_id" => ['required', 'integer']
            ]);
            $interaction = TicketInteraction::create($request->all());
            return response()->json([
                "message" => 'Added successfully',
                "data" => $interaction
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                "message" => 'Failed to add',
                "data" => $e->getMessage(),
                "request" => $request->all()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rol = TicketInteraction::find($id);
        return response()->json([
            "message" => 'Info ticket', 
            "data" => $rol
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // no se debe editar 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticket = TicketInteraction::find($id);
        $ticket->ticketInteractions->delete();
        $ticket->delete();

        return response()->json([
            "message" => 'Deleted ',
            "data" => $ticket
        ], 200);
    }
}
