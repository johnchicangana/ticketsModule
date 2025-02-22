<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = User::orderby('id','asc')->paginate(10);
        return response()->json([
            "message" => 'List of Users',
            "data" => $list	
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::with(['roles:id,name','interactions:id,message,user_id', 'interactions.ticketInteractions:id,ticket_id,interaction_id', 'interactions.ticketInteractions.ticket:id,type,status,priority'])->find($id, ['id','name', 'last_name']);
        return response()->json([
            "message" => 'Info User',
            "data" => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
