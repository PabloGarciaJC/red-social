<?php

namespace App\Listeners;

use Auth;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Auth\Events\Login;
use App\Events\BroadcastUserSessionChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

use function Psy\debug;

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
        $usuario = User::find($event->user->id);
        $usuario->conectado = 1;
        $usuario->save();
 
        $queryChange = [];

        $userReceptor = DB::table('users')
            ->join('followers', 'users.id', '=', 'followers.user_id')
            ->where('followers.user_id', Auth::user()->id)
            ->where('followers.estado', 'confirmado')
            ->select('users.*', 'followers.estado')
            ->first();

        $queryChange['userReceptor'] = $userReceptor;

        $queryEmisor = DB::table('users')
            ->join('followers', 'users.id', '=', 'followers.seguido')
            ->where('followers.seguido', $event->user->id)
            ->where('followers.estado', 'confirmado')
            ->select('users.*', 'followers.estado')
            ->first();

        $queryChange['userEmisor'] = $queryEmisor;

        // \Log::debug("{$this->user}");
        broadcast(new BroadcastUserSessionChanged(json_encode($queryChange)));

        return response()->json($queryChange, 200);
    }
}
