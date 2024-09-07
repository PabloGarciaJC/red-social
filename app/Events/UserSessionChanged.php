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
    public $messaje;
    public $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($usuarios, $messaje, $type)
    {
        $this->usuarios = $usuarios;
        $this->messaje = $messaje;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // \Log::debug("{$this->usuarios}");
        return new Channel('notifications');
    }
}
