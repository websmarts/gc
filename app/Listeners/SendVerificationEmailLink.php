<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationEmailLink
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        
        //dd($event->model);
        $details = [
            'email' => $event->model->email,
            'token' => $event->model->email_verification_token
        ];

        Mail::to($event->model->email)
            ->queue(new EmailVerificationMessage($details));
    }
}
