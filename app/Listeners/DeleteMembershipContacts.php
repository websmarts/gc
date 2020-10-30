<?php

namespace App\Listeners;


use App\Events\MembershipWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteMembershipContacts
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
    public function handle( MembershipWasDeleted $event)
    {
        // TODO delete Membership contacts when membership Model deleted 
    }
}
