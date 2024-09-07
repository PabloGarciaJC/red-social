<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;

class FollowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Follower::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        // Realiza la consulta para obtener todos los usuarios seguidos por $userId con estado 'confirmado'
        $followedUsers = DB::table('users')
            ->join('followers', 'users.id', '=', 'followers.seguido')
            ->where('followers.user_id', $userId) // Filtro por el ID del usuario que sigue
            ->where('followers.estado', 'confirmado') // Filtro por el estado
            ->select('users.*') // Selecciona todas las columnas de la tabla 'users'
            ->get();
    
        // Retorna los usuarios seguidos como una respuesta JSON
        return response()->json($followedUsers, 200);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follower $follower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follower $follower)
    {
        //
    }
}
