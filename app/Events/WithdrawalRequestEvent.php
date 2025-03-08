<?php

namespace App\Events;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WithdrawalRequestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Withdrawal $withdrawal;

    /**
     * Create a new event instance.
     * @param App\Models\Withdrawal $withdrawal
     * @param App\Models\User $user
     * @return void
     */
    public function __construct(Withdrawal $withdrawal)
    {
        $this->withdrawal = $withdrawal;
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
