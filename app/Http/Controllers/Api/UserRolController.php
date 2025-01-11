<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRol;
use Illuminate\Http\Request;

class UserRolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = UserRol::orderby('id','asc')->paginate(10);
        return response()->json([
            "message" => 'List of Users/Roles',
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
        $rol = UserRol::find($id);
        return response()->json([
            "message" => 'Info user/rol', 
            "data" => $rol
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserRol $userRol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRol $userRol)
    {
        //
    }
}
