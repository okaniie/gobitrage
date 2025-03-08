<?php

namespace App\Events;

use App\Models\UserPenalty;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddPenaltyConfirmedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public UserPenalty $penalty;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UserPenalty $penalty)
    {
        $this->penalty = $penalty;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
