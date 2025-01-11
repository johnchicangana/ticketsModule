<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interaction;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Interaction::orderby('id','asc')->paginate(10);
        return response()->json([
            "message" => 'List of Interactions',
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
                "message" => ['required', 'string', 'max:255'],
                "user_id" => ['required', 'integer']
            ]);
            $interaction = Interaction::create($request->all());
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
        $rol = Interaction::with('ticketInteractions')->find($id);
        return response()->json([
            "message" => 'Info interaction', 
            "data" => $rol
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $interaction = Interaction::find($id);
        $interaction->message = $request->message;
        $interaction->save();
        return response()->json([
            "message" => 'Updated successfully',
            "data" => $interaction
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Interaction::find($id);
        $student->delete();
        return response()->json([
            "message" => 'Deleted interaction',
            "data" => $student
        ], 200);
    }
}
