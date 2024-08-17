<?php

namespace App\Notifications;

use App\Models\Follower;
use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcast; /* Clase para Trasmitir en Vivo */
// use Illuminate\Notifications\Messages\BroadcastMessage; /* Objeto para Trasmitir en Vivo */
use App\Events\AgregarAmigosNotificacion;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AgregarAmigoNotification extends Notification 
{
    use Queueable;

    // protected $followers;
    public $objetoFollowerRecibir;
    public $objetoUserLoginEnviar;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($objetoFollowerRecibir, $objetoUserLoginEnviar)
    {
        $this->objetoFollowerRecibir = $objetoFollowerRecibir;
        $this->objetoUserLoginEnviar = $objetoUserLoginEnviar;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return array
    //  */

    public function toArray($notifiable)
    {
        return [
            'idFollowerRecibir' => $this->objetoFollowerRecibir->id,
            'idUserLoginEnviar' => $this->objetoUserLoginEnviar->id,
            'alias' => $this->objetoUserLoginEnviar->alias,
            'fotoPerfil' => $this->objetoUserLoginEnviar->fotoPerfil,
            'created_at' => $this->objetoUserLoginEnviar->created_at,
            'mensaje' => 'Te Envio una Solicitud de Amistad',
        ];

    }

}
