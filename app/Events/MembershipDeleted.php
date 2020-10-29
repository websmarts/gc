<?php

namespace App\Events;

use App\Models\Membership;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MembershipDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $membership;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Membership $membership)
    {
        $this->membership = $membership; // the soft-deleted membership
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
       // return new PrivateChannel('channel-name');
    }
}
