<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserSessionChanged implements ShouldBroadcast

{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $usuarios;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // Storage/logs => es donde se muestra los debug
        \Log::debug("{$this->usuarios}");
        return new Channel('notificationss');
    }
}
