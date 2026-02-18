<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RepliesEvents implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $replies;
    /**
     * Create a new event instance.
     */
    public function __construct($replies)
    {
        $this->replies = $replies;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function  broadcastOn(): array
    {
        return [
            new Channel('replies.' . $this->replies->discussion_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'replies.created';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->replies->id,
            'content' => $this->replies->content,
            'discussion_id' => $this->replies->discussion_id,
            'user' => $this->replies->user->name ?? 'unknown',
        ];
    }
}
