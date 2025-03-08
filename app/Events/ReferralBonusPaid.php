<?php

namespace App\Events;

use App\Models\Referral;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReferralBonusPaid
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * The referral instance.
     *
     * @var \App\Models\Referral
     */
    public Referral $referral;

    public float $amount;

    /**
     * Create a new event instance.
     * @param \App\Models\Referral $referral
     * @return void
     */
    public function __construct(Referral $referral, float $amount)
    {
        $this->referral = $referral;
        $this->amount = $amount;
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
