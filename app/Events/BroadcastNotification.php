<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class  BroadcastNotification implements ShouldBroadcast

{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $objetoFollowerRecibir;
    public $userEmisor;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($userEmisor)
    {
        $this->userEmisor = $userEmisor;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // \Log::debug("{$this->userEmisor}");
        return new Channel('broadcastNotification-channel');
    }

    public function broadcastAs()
    {
        return new Channel('broadcastNotification-event');
    }
}
