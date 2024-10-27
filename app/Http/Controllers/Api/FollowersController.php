<?php
namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Follower;
use App\Models\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;

class FollowersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        $queryChange = [];

        // Obtener usuarios que sigue el usuario actual (emisores de mensajes al usuario)
        $usersEmisor = DB::table('users')
            ->join('followers', 'users.id', '=', 'followers.seguido')
            ->where('followers.user_id', $userId)
            ->where('followers.estado', 'confirmado')
            ->select('users.*', 'followers.estado')
            ->get();

        // Agregar la cuenta de mensajes no leídos de los emisores
        foreach ($usersEmisor as $user) {
            $unreadMessagesCount = Chat::where('emisor_id', $user->id)  // Mensajes enviados por el emisor
                ->where('receptor_id', $userId)                         // Al usuario actual
                ->where('leido', 0)                                     // Que no han sido leídos
                ->count();

            // Agregar la cantidad de mensajes no leídos al resultado
            $user->unread_messages = $unreadMessagesCount;
        }

        $queryChange['usersEmisor'] = $usersEmisor;

        // Obtener usuarios que siguen al usuario actual (usuarios receptores)
        $userReceptor = DB::table('users')
            ->join('followers', 'users.id', '=', 'followers.user_id')
            ->where('followers.seguido', $userId)
            ->where('followers.estado', 'confirmado')
            ->select('users.*', 'followers.estado')
            ->get();

        // Agregar la cuenta de mensajes no leídos de los (usuarios receptores)
        foreach ($userReceptor as $user) {
            $unreadMessagesCount = Chat::where('emisor_id', $user->id)  // Mensajes enviados por el receptor (seguidor)
                ->where('receptor_id', $userId)                          // Al usuario actual
                ->where('leido', 0)                                      // Que no han sido leídos
                ->count();

            // Agregar la cantidad de mensajes no leídos al resultado
            $user->unread_messages = $unreadMessagesCount;
        }

        $queryChange['userReceptor'] = $userReceptor;

        // Retornar los usuarios seguidos y los seguidores con la cantidad de mensajes no leídos
        return response()->json($queryChange, 200);
    }
}
