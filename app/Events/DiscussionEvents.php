<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DiscussionEvents implements ShouldBroadcast
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $discussion;

    /**
     * Create a new event instance.
     */
    public function __construct($discussion)
    {
        $this->discussion = $discussion;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function  broadcastOn(): array
    {
        return [
            new Channel('discussion.' . $this->discussion->course_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'discussion.created';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->discussion->id,
            'content' => $this->discussion->content,
            'course_id' => $this->discussion->course_id,
            'user' => $this->discussion->user->name ?? 'unknown',
        ];
    }
}
