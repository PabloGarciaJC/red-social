<?php

namespace App\Http\Controllers;

use Auth;
use Notification;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\AgregarAmigosNotificacion;
use App\Notifications\AgregarAmigoNotification;
use App\Notifications\SolicitudAceptadaNotification;
use App\Notifications\SolicitudCanceladaNotification;
use App\Events\BroadcastNotification;
use Illuminate\Support\Facades\Redirect; // Asegúrate de importar Redirect


class FollowersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function enviarSolicitud(Request $request)
    {
        // Busca al usuario receptor
        $userReceptor = User::find($request->input('userReceptor'));

        // Busca si ya existe un registro de Follower con los mismos user_id y seguido
        $follower = Follower::where('user_id', Auth::user()->id)
            ->where('seguido', $userReceptor->id)
            ->first();

        $messaje = 'Has enviado una solicitud de amistad';

        if ($follower) {
            // Si existe, actualiza el campo 'estatus'
            $follower->estatus = 0;
        } else {
            // Si no existe, crea un nuevo registro
            $follower = new Follower();
            $follower->user_id = Auth::user()->id;
            $follower->seguido = $userReceptor->id;
            $follower->estatus = 0;
        }

        // Guarda los cambios en la base de datos
        $follower->save();

        // se crea notificaciones
        $userReceptor->notify(new AgregarAmigoNotification(Auth::user(), '0',  $messaje));

        // Redirige a la URL con el parámetro agregado
        $currentUrl = url()->previous();
        $newUrl = preg_replace('/(\?|&)addFriend=\d*/', '', $currentUrl);
        $newUrl .= (strpos($newUrl, '?') === false ? '?' : '&') . 'addFriend=1';

        return redirect()->to($newUrl)->with('success', $messaje);
    }

    public function cancelarContacto(Request $request)
    {
        // Busca al usuario receptor
        $userReceptor = User::find($request->input('userReceptor'));

        // Busca si ya existe un registro de Follower con los mismos user_id y seguido
        $follower = Follower::where('user_id', Auth::user()->id)
            ->where('seguido', $userReceptor->id)
            ->first();

        if ($follower) {
            // Si existe, actualiza el campo 'estatus'
            $follower->estatus = 0;
            $messaje = 'Se ha cancelado la solicitud de amistad';

            // Busca la notificación que corresponde a la solicitud de amistad cancelada
            $notification = DB::table('notifications')
                ->where('type', 'App\Notifications\AgregarAmigoNotification')
                ->where('notifiable_id', $userReceptor->id)
                ->where('data', 'LIKE', '%"user_id":' . Auth::user()->id . '%')
                ->first();

            if ($notification) {
                // Elimina la notificación
                DB::table('notifications')->where('id', $notification->id)->delete();
            }
        }

        // Guarda los cambios en la base de datos
        $follower->save();

        // Redirige a la URL con el parámetro agregado
        $currentUrl = url()->previous();
        $newUrl = preg_replace('/(\?|&)addFriend=\d*/', '', $currentUrl);
        $newUrl .= (strpos($newUrl, '?') === false ? '?' : '&') . 'addFriend=0';

        return redirect()->to($newUrl)->with('error', $messaje);
    }
}
