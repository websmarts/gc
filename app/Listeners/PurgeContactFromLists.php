<?php

namespace App\Listeners;

use App\Events\ContactDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PurgeContactFromLists
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
     * @param  ContactDeleted  $event
     * @return void
     */
    public function handle(ContactDeleted $event)
    {
        dd('dying inside the handle method of the PurgeContactFromLists Listener');
    }
}
