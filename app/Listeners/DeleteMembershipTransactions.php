<?php

namespace App\Listeners;

use App\Events\MembershipDeleted;
use App\Events\MembershipWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
    public function handle(MembershipWasDeleted $event)
    {
       // TODO delete Transactions for deleted Membership Model
    }
}
