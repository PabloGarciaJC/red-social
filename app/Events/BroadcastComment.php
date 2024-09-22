<?php

namespace App\Events;

use App\Models\comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;

class BroadcastComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $objetoFollowerRecibir;
    public $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */

     public function __construct($comment)
     {
         $this->comment = $comment;
     }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('broadcastComment-channel');
    }

    public function broadcastAs()
    {
          \Log::debug("{$this->comment}");
        return new Channel('broadcastComment-event');
    }
}
