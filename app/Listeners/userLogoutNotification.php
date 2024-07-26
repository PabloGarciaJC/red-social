<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Auth\Events\Login;
use App\Events\UserSessionChanged;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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

        $arrayListados = array();

        // Show Users for Auth
        $allSeguidos = Follower::where('user_id', $event->user->id)->where('aprobada', '=', 1)->get();

        foreach ($allSeguidos as $followers) {
            $user = $followers->user;
            array_push($arrayListados, $user);
        }

        // Show Auth for Users
        $allUsers = Follower::where('seguido', $event->user->id)->where('aprobada', '=', 1);
        $user = User::find($event->user->id);
        array_push($arrayListados, $user);

        $convertObjectArray = (object)$arrayListados;
        $arrayListadosJson = json_encode($convertObjectArray);
        broadcast(new UserSessionChanged($arrayListadosJson));
        return response()->json($arrayListadosJson, 200, []);
    }
}
