<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LogLastLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user             = $event->user;
        $user->last_login = new \DateTime;
        $user->save();
    }
}
