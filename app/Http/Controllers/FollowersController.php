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

    public function agregarContacto(Request $request)
    {
        $usuarioLogin = $request->get('usuarioLogin');
        $usuarioSeguido = $request->get('usuarioSeguido');
        $friendRequestSend = $request->get('friendRequestSend');
        $friendRequestReceived = $request->get('friendRequestReceived');
        $idNotificacion = $request->get('idNotificacion');

        // Obtengo Objetos
        $objetoUserLoginEnviar = User::find($usuarioLogin);
        $objetoFollowerRecibir = User::find($usuarioSeguido);

        $follower = new Follower();

        if ($friendRequestSend == 0) {

            if ($idNotificacion === '0') {

                $registerFollowerSend = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id)->where('aprobada', '=', 0);

                if ($registerFollowerSend->count() == 0) {

                    $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoFollowerRecibir, $objetoUserLoginEnviar));

                    if ($friendRequestReceived == 1) {

                        echo 'friendAfterReceived';
                    } else {

                        $saveFollowerReceived = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id)->where('aprobada', '=', 0);


                        if ($saveFollowerReceived->count() == 1) {

                            foreach ($saveFollowerReceived->get() as $showFollorwer) {

                                $follower = $follower->find($showFollorwer->id);
                                $follower->user_id = $objetoFollowerRecibir->id;
                                $follower->seguido = $objetoUserLoginEnviar->id;
                                $follower->aprobada = 1;
                                $follower->save();

                                echo 'saveFollowerReceived';
                            }
                        } else {

                            $follower->user_id = $objetoUserLoginEnviar->id;
                            $follower->seguido = $objetoFollowerRecibir->id;
                            $follower->aprobada = 0;
                            $follower->save();

                            echo 'send';
                        }
                    }
                } else {

                    echo 'existSend';
                }
            } else {

                $sendAfterReceived = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

                if ($sendAfterReceived->count() == 0) {

                    $saveReceivedAfterReceived = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

                    if ($saveReceivedAfterReceived->count() == 0) {

                        $follower->user_id = $objetoFollowerRecibir->id;;
                        $follower->seguido = $objetoUserLoginEnviar->id;
                        $follower->aprobada = 0;

                        $objetoFollowerRecibir->notify(new AgregarAmigoNotification($objetoFollowerRecibir, $objetoUserLoginEnviar));

                        $follower->save();

                        echo 'sendAfterReceived';
                    } else {

                        foreach ($saveReceivedAfterReceived->get() as $registerFollower) {
                            $follower = $follower->find($registerFollower->id);
                            $follower->aprobada = 1;
                            $follower->save();
                        }

                        $objetoFollowerRecibir->notify(new SolicitudAceptadaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));

                        echo 'saveReceivedAfterReceived';
                    }
                } else {

                    $objetoFollowerRecibir->notify(new SolicitudAceptadaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));
                    foreach ($sendAfterReceived->get() as $follower) {
                        $follower = $follower->find($follower->id);
                        $follower->aprobada = 1;
                        $follower->save();
                    }
                    echo 'saveAfterReceivedFriends';
                }
            }
        } else {
            echo 'approvedFriends';
        }
    }

    public function cancelarContacto(Request $request)
    {
        $usuarioLogin = $request->get('usuarioLogin');
        $usuarioSeguido = $request->get('usuarioSeguido');
        $idNotificacion = $request->get('idNotificacion');
        $friendRequestSend = $request->get('friendRequestSend');
        $friendRequestReceived = $request->get('friendRequestReceived');

        // Obtengo Objetos
        $objetoUserLoginEnviar = User::find($usuarioLogin);
        $objetoFollowerRecibir = User::find($usuarioSeguido);

        $follower = new Follower();

        $registerFollowerSend = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

        if ($registerFollowerSend->count() == 0) {

            $followerSend = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

            if ($followerSend->count() == 1) {

                foreach ($followerSend->get() as $followerDelete) {

                    $follower = $follower->find($followerDelete->id);
                    $follower->delete();
                    echo 'deleteFollower';
                }

            } else {

                echo 'noNeedToDelete';
            }
        } else {

            if ($idNotificacion === '0') {

                //  Obtengo las Notificaciones del Usuario
                $notifications = $objetoFollowerRecibir->notifications;

                //  Borro las Notificaciones que vienen en Json y Comparo con los informacion que tengo.
                // foreach ($notifications as $clave => $value) {
                //     if ($value['data']['alias'] == $objetoUserLoginEnviar->alias && $value['data']['idFollowerRecibir'] == $objetoFollowerRecibir->id) {
                //         DB::table('notifications')->whereId($value['id'])->delete();
                //     }

                // Borro Registro de Follower
                $registerFollowerSend = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

                if ($registerFollowerSend->count() == 0) {

                    $registerFollowerDelete = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

                    foreach ($registerFollowerDelete->get() as $followerDelete) {

                        $follower = $follower->find($followerDelete->id);
                        $follower->delete();
                        echo 'followerReceived';
                    }

                } else {

                    foreach ($registerFollowerSend->get() as $follower) {
                        $borrarDeleteFollower = $follower->find($follower->id);
                        $borrarDeleteFollower->delete();
                    }

                    echo 'sendCancelar';
                }
            } else {

                $sendAfterReceived = $follower->where('user_id', '=', $objetoFollowerRecibir->id)->where('seguido', '=', $objetoUserLoginEnviar->id);

                if ($sendAfterReceived->count() == 1) {

                    foreach ($sendAfterReceived->get() as $follower) {
                        $borrarDeleteFollower = $follower->find($follower->id);
                        $borrarDeleteFollower->delete();
                    }

                    $objetoFollowerRecibir->notify(new SolicitudCanceladaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));

                    echo 'cancelAfterReceived';

                } else {

                    $showFollower = $follower->where('user_id', '=', $objetoUserLoginEnviar->id)->where('seguido', '=', $objetoFollowerRecibir->id);

                    if ($showFollower->count() == 1) {

                        foreach ($showFollower->get() as $showRegister) {

                            $borrarDeleteFollower = $follower->find($showRegister->id);
                            $borrarDeleteFollower->delete();
                        }

                        echo 'deleteReceivedAfterReceived';

                        $objetoFollowerRecibir->notify(new SolicitudCanceladaNotification($objetoUserLoginEnviar, $objetoFollowerRecibir));
                        
                    } else {

                        echo 'existAfterReceived';
                    }
                }
            }
        }
    }
}
