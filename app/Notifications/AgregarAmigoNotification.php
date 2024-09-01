<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AgregarAmigoNotification extends Notification
{
    use Queueable; // Permite que la notificación sea manejada en la cola si se configura así

    // Propiedades que almacenan los datos necesarios para la notificación
    protected $userLogin;
    protected $addFriend;
    protected $messaje;

    /**
     * Crear una nueva instancia de notificación.
     *
     * @param  mixed  $userLogin  El usuario que está enviando la solicitud de amistad
     * @param  string  $mensaje  El mensaje de la notificación
     * @return void
     */
    public function __construct($userLogin, $addFriend, $messaje)
    {
        $this->userLogin = $userLogin;
        $this->addFriend = $addFriend;
        $this->messaje = $messaje;
    }

    /**
     * Determinar los canales de notificación que deberían ser utilizados.
     *
     * @param  mixed  $notifiable  El modelo que recibe la notificación
     * @return array
     */
    public function via($notifiable)
    {
        // Define los canales a través de los cuales se enviará la notificación
        // 'database' almacena la notificación en la base de datos
        // 'broadcast' emite la notificación en tiempo real
        return ['database', 'broadcast'];
    }

    /**
     * Obtener la representación de la notificación como un mensaje de correo.
     *
     * @param  mixed  $notifiable  El modelo que recibe la notificación
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Crea un mensaje de correo que será enviado al usuario
        return (new MailMessage)
            ->action('Ver solicitud', url('/')) // Acción para ver la solicitud
            ->line('Gracias por usar nuestra aplicación!'); // Línea de agradecimiento
    }

    /**
     * Obtener el arreglo de datos que deberían ser almacenados en la base de datos.
     *
     * @param  mixed  $notifiable  El modelo que recibe la notificación
     * @return array
     */
    public function toDatabase($notifiable)
    {

        // Devuelve un arreglo con los datos que se almacenarán en la base de datos
        return [
            'user_id' => $this->userLogin->id,
            'alias' => $this->userLogin->alias,
            'fotoPerfil' => $this->userLogin->fotoPerfil,
            'addFriend' => $this->addFriend,
            'messaje' => $this->messaje
        ];
    }

    /**
     * Convertir la notificación a un arreglo para almacenamiento en la base de datos.
     *
     * @param  mixed  $notifiable  El modelo que recibe la notificación
     * @return array
     */
    public function toArray($notifiable)
    {
        // Devuelve un arreglo con los datos necesarios para la notificación en la base de datos
        return [
            'user_id' => $this->userLogin->id,
            'alias' => $this->userLogin->alias,
            'fotoPerfil' => $this->userLogin->fotoPerfil,
            'addFriend' => $this->addFriend,
            'messaje' => $this->messaje
        ];
    }
}
