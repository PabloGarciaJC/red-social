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
            
            // Si existe, actualiza el campo 'estado'
            $follower->estado = 'pendiente';
            
        } else {
            // Si no existe, crea un nuevo registro
            $follower = new Follower();
            $follower->user_id = Auth::user()->id;
            $follower->seguido = $userReceptor->id;
            $follower->estado = 'pendiente';
        }

        // Guarda los cambios en la base de datos
        $follower->save();

        // se crea notificaciones
        $userReceptor->notify(new AgregarAmigoNotification(Auth::user(), '0',  $messaje));

        // Redirigir al controlador
        return redirect()->route('detalles.perfil', [
            'perfil' => $userReceptor->alias,
            'estado' => 'pendiente'
        ])->with('success', $messaje);
    }

    public function cancelarContacto(Request $request)
    {
        // Busca al usuario receptor
        $userReceptor = User::find($request->input('userReceptor'));

        // Busca si ya existe un registro de Follower con los mismos user_id y seguido
        $follower = Follower::where('user_id', Auth::user()->id)
            ->where('seguido', $userReceptor->id)
            ->where('estado', 'pendiente')
            ->first();

        $messaje = 'Se ha cancelado la solicitud de amistad';

        if ($follower) {

            // Si no existe, crea un nuevo registro
            $follower->estado = 'desconocido';

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

        // Redirigir al controlador
        return redirect()->route('detalles.perfil', [
            'perfil' => $userReceptor->alias,
            'estado' => 'desconocido'
        ])->with('error', $messaje);
    }
}
