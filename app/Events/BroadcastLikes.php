<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;

class BroadcastLikes implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $objetoFollowerRecibir;
    public $likes;
    public $dislike;
    public $postId;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($likes, $dislike, $postId)
    {
        $this->likes = $likes;
        $this->dislike = $dislike;
        $this->postId = $postId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('broadcastLikes-channel');
    }

    public function broadcastAs()
    {
        // \Log::debug("{$this->likes}");
        // \Log::debug("{$this->dislike}");
        // \Log::debug("{$this->postId}");
        return new Channel('broadcastLikes-event');
    }
}
