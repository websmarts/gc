<?php

namespace App\Listeners;

use App\Events\MembershipDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteMembershipTransactions
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MembershipDeleted  $event
     * @return void
     */
    public function handle(MembershipDeleted $event)
    {
        //
    }
}
