<?php

namespace App\Notifications;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SolicitudCanceladaNotification extends Notification
{
    use Queueable;
    public $userLogin;
    public $idFollower;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userLogin, $idFollower)
    {
        $this->userLogin = $userLogin;
        $this->idFollower = $idFollower;
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'idUserLoginEnviar' => $this->idFollower->id,
            'alias' => $this->userLogin->alias,
            'fotoPerfil' => $this->userLogin->fotoPerfil,
            'mensaje' => 'Solicitud de Amistad Cancelada',
        ];
    }
}
