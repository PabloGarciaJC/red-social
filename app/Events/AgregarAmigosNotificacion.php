<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AgregarAmigosNotificacion implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $objetoFollower;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($objetoFollower)
    {
        $this->objetoFollower = $objetoFollower;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('agregarAmigos');
    }

    /**
     * Get the broadcastable representation of the event.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'idFollower' => $this->objetoFollower->id,
            'alias' => $this->objetoFollower->alias,
        ];
    }
}
