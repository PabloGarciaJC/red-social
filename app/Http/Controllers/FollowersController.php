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
use Illuminate\Support\Facades\Redirect;


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

    public function enviar(Request $request)
    {
        // Busca al usuario receptor
        $userReceptor = User::find($request->input('userReceptor'));

        // Busca si ya existe un registro de Follower con los mismos user_id y seguido
        $follower = Follower::where('user_id', Auth::user()->id)
            ->where('seguido', $userReceptor->id)
            ->first();

        $messajeNotification = 'Te envio una solicitud de amistad';
        $messaje = 'Has enviado solicitud de amistad';
        $estado = 'enviado';

        if ($follower) {
            // Si existe, actualiza el campo 'estado'
            $follower->estado = $estado;
        } else {
            // Si no existe, crea un nuevo registro
            $follower = new Follower();
            $follower->user_id = Auth::user()->id;
            $follower->seguido = $userReceptor->id;
            $follower->estado = $estado;
        }

        // Guarda los cambios en la base de datos
        $follower->save();

        // se crea notificaciones
        $userReceptor->notify(new AgregarAmigoNotification(Auth::user(), $estado, $messajeNotification));

        // Emitir la notificación a través de Pusher
        event(new BroadcastNotification(Auth::user(), $estado, $messajeNotification));

        // Redirigir al controlador
        return redirect()->route('detalles.perfil', [
            'perfil' => $userReceptor->alias,
            'estado' => $estado,
            'notificacion' => 1
        ])->with('success', $messaje);
    }

    public function cancelar(Request $request)
    {
        // Busca al usuario receptor
        $userReceptor = User::find($request->input('userReceptor'));

        // Busca si ya existe un registro de Follower con los mismos user_id y seguido
        $follower = Follower::where('user_id', Auth::user()->id)
            ->where('seguido', $userReceptor->id)
            ->where('estado', 'enviado')
            ->first();

        $messaje = 'Se ha cancelado la solicitud de amistad';
        $estado = 'desconocido';

        if ($follower) {

            // Guarda los cambios en la base de datos
            $follower->save();

            // Si no existe, crea un nuevo registro
            $follower->estado = $estado;

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

        // Redirigir al controlador
        return redirect()->route('detalles.perfil', [
            'perfil' => $userReceptor->alias,
            'estado' => $estado
        ])->with('error', $messaje);
    }

    public function confirmar(Request $request)
    {
        // Busca al usuario receptor
        $userReceptor = User::find($request->input('userReceptor'));

        // Busca si ya existe un registro de Follower con los mismos user_id y seguido
        $follower = Follower::where('user_id', $userReceptor->id)
            ->where('seguido', Auth::user()->id)
            ->where('estado', 'enviado')
            ->first();

        $messajeNotification = 'Acepto solicitud de amistad';
        $messaje = 'Has aceptado solicitud de amistad';
        $estado = 'confirmado';

        // Busca la notificación que corresponde a la solicitud de amistad cancelada
        $notification = DB::table('notifications')
            ->where('type', 'App\Notifications\AgregarAmigoNotification')
            ->where('notifiable_id', Auth::user()->id)
            ->where('data', 'LIKE', '%"user_id":' . $userReceptor->id . '%')
            ->first();

        if ($notification) {
            // Elimina la notificación
            DB::table('notifications')->where('id', $notification->id)->delete();
        }

        if ($follower) {
            $follower->estado = $estado;
        }

        // Guarda los cambios en la base de datos
        $follower->save();

        // se crea notificaciones
        $userReceptor->notify(new AgregarAmigoNotification(Auth::user(), $follower->estado,  $messajeNotification));

        // Emitir la notificación a través de Pusher
        event(new BroadcastNotification(Auth::user(), $follower->estado, $messajeNotification));

        // Redirigir al controlador
        return redirect()->route('detalles.perfil', [
            'perfil' => $userReceptor->alias,
            'estado' => $estado
        ])->with('success', $messaje);
    }

    public function denegar(Request $request)
    {




        // Busca al usuario receptor
        $userReceptor = User::find($request->input('userReceptor'));

        // Busca si ya existe un registro de Follower con los mismos user_id y seguido (para ambas direcciones)
        $follower = Follower::where(function ($query) use ($userReceptor) {
            $query->where('user_id', Auth::user()->id)
                ->where('seguido', $userReceptor->id);
        })
            ->orWhere(function ($query) use ($userReceptor) {
                $query->where('user_id', $userReceptor->id)
                    ->where('seguido', Auth::user()->id);
            })
            ->where('estado', 'confirmado')
            ->first();

        $mensaje = 'Ha cancelado la solicitud de amistad';
        $estado = 'desconocido';

        // Busca la notificación que corresponde a la solicitud de amistad cancelada
        $notification = DB::table('notifications')
            ->where('type', 'App\Notifications\AgregarAmigoNotification')
            ->where('notifiable_id', Auth::user()->id)
            ->where('data', 'LIKE', '%"user_id":' . $userReceptor->id . '%')
            ->first();

        if ($notification) {
            // Elimina la notificación
            DB::table('notifications')->where('id', $notification->id)->delete();
        }

        if ($follower) {
            // Cambia el estado a 'desconocido'
            $follower->estado = $estado;

            // Guarda los cambios en la base de datos
            $follower->save();

            // se crea notificaciones
            $userReceptor->notify(new AgregarAmigoNotification(Auth::user(), $follower->estado,  $mensaje));

            // Emitir la notificación a través de Pusher
            event(new BroadcastNotification(Auth::user(), $follower->estado, $mensaje));
        }

        // Redirigir al controlador
        return redirect()->route('detalles.perfil', [
            'perfil' => $userReceptor->alias,
            'estado' => $estado
        ])->with('error', $mensaje);


        $user = Auth::user();
        if ($user->status === 'active') {
            return redirect()->route('detalles.perfil', [
                'perfil' => $userReceptor->alias,
                'estado' => $estado
            ])->with('error', 'Ha cancelado la solicitud de amistad');
        } else {

            return redirect()->route('detalles.perfil', [
                'perfil' => $userReceptor->alias,
                'estado' => $estado
            ])->with('error', $mensaje);
        }
    }
}
