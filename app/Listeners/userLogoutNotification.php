<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Auth\Events\Login;
use App\Events\UserSessionChanged;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class userLogoutNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    public function handle(logout $event)
    {
        $usuario = User::find($event->user->id);
        $usuario->conectado = 0;
        $usuario->save();

        $userReceptor = DB::table('users')
            ->join('followers', 'users.id', '=', 'followers.seguido')
            ->where('followers.seguido', $event->user->id)
            ->where('followers.estado', 'confirmado')
            ->select('users.*', 'followers.estado')
            ->get();

        // Emitir la notificación a través de Pusher
        broadcast(new UserSessionChanged($userReceptor));
        
        // Retorna los usuarios seguidos y los seguidores como una respuesta JSON
        return response()->json($userReceptor, 200);
    }
}
