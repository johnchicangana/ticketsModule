<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('users', 'App\Http\Controllers\Api\UserController')->parameters(['users' => 'id'])->names('users');
Route::apiResource('roles', 'App\Http\Controllers\Api\RolController')->parameters(['roles' => 'id'])->names('roles');
Route::apiResource('user-roles', 'App\Http\Controllers\Api\UserRolController')->parameters(['user-roles' => 'id'])->names('user-roles');
Route::apiResource('interactions', 'App\Http\Controllers\Api\InteractionController')->parameters(['interactions' => 'id'])->names('interactions');
Route::apiResource('tickets', 'App\Http\Controllers\Api\TicketController')->parameters(['tickets' => 'id'])->names('tickets');
Route::apiResource('ticket-interactions', 'App\Http\Controllers\Api\TicketInteractionController')->parameters(['ticket-interactions' => 'id'])->names('ticket-interactions');
