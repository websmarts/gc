<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Events\MembershipWasDeleted;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Events\NewEmailAddressRecorded;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MembershipWasDeleted::class => [
            'App\Listeners\DeleteMembershipContacts',
            'App\Listeners\DeleteMembershipTransactions',
        ],
        NewEmailAddressRecorded::class => [
            'App\Listeners\SendVerificationEmailLink'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
