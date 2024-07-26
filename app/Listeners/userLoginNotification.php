<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Auth\Events\Login;
use App\Events\UserSessionChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class userLoginNotification
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

    public function handle(login $event)
    {
        // Conectado Usuario
        $usuario = User::find($event->user->id);
        $usuario->conectado = 1;
        $usuario->save();

        $arrayListados = array();

        // Show Users for Auth
        $allFollowers = Follower::where('user_id', $event->user->id)->where('aprobada', '=', 1)->get();

        foreach ($allFollowers as $followers) {
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
