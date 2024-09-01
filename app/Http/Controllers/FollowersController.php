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

        $userReceptor = User::find($request->input('userReceptor'));
        $follower = new Follower();
        $follower->user_id = Auth::user()->id;
        $follower->seguido = $userReceptor->id;
        $follower->aprobada = 0;
        $follower->save();
        $messaje = 'Has enviado una solicitud de amistad';

        // se crea notificaciones
        $userReceptor->notify(new AgregarAmigoNotification(Auth::user(), '0',  $messaje));

        // Emite un evento para notificaciones en tiempo real
        event(new BroadcastNotification(Auth::user()));

        // Redirige a la URL con el parámetro agregado
        return redirect()->to(url()->previous() . '?' . http_build_query(['solicitud-enviada' => 1]))->with('success', $messaje);


        // $registerFollowerSend = $follower->where('user_id', '=', $userAuth->id)->where('seguido', '=', $userReceptor->id)->where('aprobada', '=', 0);


        // if ($usuarioLogin && $usuarioSeguido) {
        //     // Crear una nueva instancia de la notificación
        //     $notification = new AgregarAmigoNotification($usuarioLogin, 'Te envió una solicitud de amistad');

        //     // Enviar la notificación solo al usuario receptor
        //     $usuarioSeguido->notify($notification);

        //     return response()->json(['success' => true], 200);
        // }

        // return response()->json(['error' => 'Usuarios no encontrados'], 404);




        // event (new \App\Events\EnviarMensaje($objetoFollowerRecibir, $objetoUserLoginEnviar));


        // if ($friendRequestSend == 0) {

        //     if ($idNotificacion === '0') {

        //         $registerFollowerSend = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id)->where('aprobada', '=', 0);

        //         if ($registerFollowerSend->count() == 0) {

        //             $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoUserLoginEnviar, 'Te envió una solicitud de amistad'));
        //             // event (new \App\Events\EnviarMensaje($objetoFollowerRecibir, $objetoUserLoginEnviar));

        //             if ($friendRequestReceived == 1) {

        //                 echo 'friendAfterReceived';
        //             } else {

        //                 $saveFollowerReceived = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id)->where('aprobada', '=', 0);


        //                 if ($saveFollowerReceived->count() == 1) {

        //                     foreach ($saveFollowerReceived->get() as $showFollorwer) {

        //                         $follower = $follower->find($showFollorwer->id);
        //                         $follower->user_id = $objetoFollowerRecibir->id;
        //                         $follower->seguido = $objetoUserLoginEnviar->id;
        //                         $follower->aprobada = 1;
        //                         $follower->save();

        //                         echo 'saveFollowerReceived';
        //                     }
        //                 } else {

        //                     $follower->user_id = $objetoUserLoginEnviar->id;
        //                     $follower->seguido = $objetoFollowerRecibir->id;
        //                     $follower->aprobada = 0;
        //                     $follower->save();

        //                     echo 'send';
        //                 }
        //             }
        //         } else {

        //             echo 'existSend';
        //         }
        //     } else {

        //         $sendAfterReceived = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

        //         if ($sendAfterReceived->count() == 0) {

        //             $saveReceivedAfterReceived = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

        //             if ($saveReceivedAfterReceived->count() == 0) {

        //                 $follower->user_id = $objetoFollowerRecibir->id;;
        //                 $follower->seguido = $objetoUserLoginEnviar->id;
        //                 $follower->aprobada = 0;
        //                 // $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoFollowerRecibir, $objetoUserLoginEnviar));
        //                 // $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoUserLoginEnviar, 'Te envió una solicitud de amistad'));
        //                 $follower->save();

        //                 echo 'sendAfterReceived';
        //             } else {

        //                 foreach ($saveReceivedAfterReceived->get() as $registerFollower) {
        //                     $follower = $follower->find($registerFollower->id);
        //                     $follower->aprobada = 1;
        //                     $follower->save();
        //                 }

        //                 // $objetoFollowerRecibir->notify(new SolicitudAceptadaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));
        //                 // $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoUserLoginEnviar, 'Te envió una solicitud de amistad'));
        //                 echo 'saveReceivedAfterReceived';
        //             }
        //         } else {

        //             // $objetoFollowerRecibir->notify(new SolicitudAceptadaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));
        //             // $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoUserLoginEnviar, 'Te envió una solicitud de amistad'));
        //             foreach ($sendAfterReceived->get() as $follower) {
        //                 $follower = $follower->find($follower->id);
        //                 $follower->aprobada = 1;
        //                 $follower->save();
        //             }
        //             echo 'saveAfterReceivedFriends';
        //         }
        //     }
        // } else {
        //     echo 'approvedFriends';
        // }
    }

    public function aceptarContacto(Request $request)
    {

        echo 'aceptar contacto';
        // $userReceptor = User::find($request->input('userReceptor'));
        // $follower = Follower::where('user_id', $userReceptor->id)
        //     ->where('seguido', Auth::user()->id)
        //     ->where('aprobada', 0)
        //     ->first();
        // if ($follower) {
        //     $follower->aprobada = 1;
        //     $follower->save();
        //     $messaje = 'Se ha aceptado la solicitud de amistad';
        //     return response()->json([
        //         'message' => $messaje
        //     ]);
        // }
    }

    public function cancelarContacto(Request $request)
    {
        $userReceptor = User::find($request->input('userReceptor'));
        $follower = Follower::where('user_id', $userReceptor->id)
            ->where('seguido', Auth::user()->id)
            ->where('aprobada', 0)
            ->first();
        if ($follower) {
            $follower->aprobada = 0;
            $follower->save();
            $messaje = 'Solicitud de amistad cancelada';
            return response()->json([
                'message' => $messaje
            ]);
        }
        // $usuarioLogin = $request->get('usuarioLogin');
        // $usuarioSeguido = $request->get('usuarioSeguido');
        // $idNotificacion = $request->get('idNotificacion');
        // $friendRequestSend = $request->get('friendRequestSend');
        // $friendRequestReceived = $request->get('friendRequestReceived');

        // // Obtengo Objetos
        // $objetoUserLoginEnviar = User::find($usuarioLogin);
        // $objetoFollowerRecibir = User::find($usuarioSeguido);

        // $follower = new Follower();

        // $registerFollowerSend = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

        // if ($registerFollowerSend->count() == 0) {

        //     $followerSend = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

        //     if ($followerSend->count() == 1) {

        //         foreach ($followerSend->get() as $followerDelete) {

        //             $follower = $follower->find($followerDelete->id);
        //             $follower->delete();
        //             echo 'deleteFollower';
        //         }
        //     } else {

        //         echo 'noNeedToDelete';
        //     }
        // } else {

        //     if ($idNotificacion === '0') {

        //         //  Obtengo las Notificaciones del Usuario
        //         $notifications = $objetoFollowerRecibir->notifications;

        //         //  Borro las Notificaciones que vienen en Json y Comparo con los informacion que tengo.
        //         // foreach ($notifications as $clave => $value) {
        //         //     if ($value['data']['alias'] == $objetoUserLoginEnviar->alias && $value['data']['idFollowerRecibir'] == $objetoFollowerRecibir->id) {
        //         //         DB::table('notifications')->whereId($value['id'])->delete();
        //         //     }

        //         // Borro Registro de Follower
        //         $registerFollowerSend = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

        //         if ($registerFollowerSend->count() == 0) {

        //             $registerFollowerDelete = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

        //             foreach ($registerFollowerDelete->get() as $followerDelete) {

        //                 $follower = $follower->find($followerDelete->id);
        //                 $follower->delete();
        //                 echo 'followerReceived';
        //             }
        //         } else {

        //             foreach ($registerFollowerSend->get() as $follower) {
        //                 $borrarDeleteFollower = $follower->find($follower->id);
        //                 $borrarDeleteFollower->delete();
        //             }

        //             echo 'sendCancelar';
        //         }
        //     } else {

        //         $sendAfterReceived = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

        //         if ($sendAfterReceived->count() == 1) {

        //             foreach ($sendAfterReceived->get() as $follower) {
        //                 $borrarDeleteFollower = $follower->find($follower->id);
        //                 $borrarDeleteFollower->delete();
        //             }

        //             $objetoFollowerRecibir->notify(new SolicitudCanceladaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));

        //             echo 'cancelAfterReceived';
        //         } else {

        //             $showFollower = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

        //             if ($showFollower->count() == 1) {

        //                 foreach ($showFollower->get() as $showRegister) {

        //                     $borrarDeleteFollower = $follower->find($showRegister->id);
        //                     $borrarDeleteFollower->delete();
        //                 }

        //                 echo 'deleteReceivedAfterReceived';

        //                 $objetoFollowerRecibir->notify(new SolicitudCanceladaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));
        //             } else {

        //                 echo 'existAfterReceived';
        //             }
        //         }
        //     }
        // }
    }
}
