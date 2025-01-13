<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interaction;
use App\Models\Ticket;
use App\Models\TicketInteraction;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Ticket::orderby('id','asc')->paginate(10);
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
                "type" => ['required', 'string', 'max:255'],
                "status" => ['required', 'string', 'max:255'],
                "priority" => ['required', 'string', 'max:255']
            ]);
            $ticket = Ticket::create($request->all());
            $interaction = Interaction::create($request->all());
            $ticketInteractions = $ticket->ticketInteractions()->create([
                'ticket_id' => $ticket->id,
                'interaction_id' => $interaction->id
            ]);

            return response()->json([
                "message" => 'Added successfully',
                "data" => $ticket,
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
        $rol = Ticket::with(['ticketInteractions', 'ticketInteractions.ticket', 'ticketInteractions.interaction'])->find($id);
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
        $ticket = Ticket::find($id);
        $ticket->status = $request->status;
        $ticket->save();

        $interaction = Interaction::create($request->all());
        $ticketInteractions = $ticket->ticketInteractions()->create([
            'ticket_id' => $ticket->id,
            'interaction_id' => $interaction->id
        ]);

        return response()->json([
            "message" => 'Updated successfully',
            "data" => $ticket
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticketInteractions = TicketInteraction::where('ticket_id', $id)->get();
        $ticketInteractions->each->delete();
        $interactions = Interaction::whereIn('id', $ticketInteractions->pluck('interaction_id'))->get();
        $interactions->each->delete();
        $ticket->delete();

        return response()->json([
            "message" => 'Deleted ticket',
            "data" => $ticket
        ], 200);
    }
}
