<?php

namespace App\Listeners;

use App\Events\AddSite;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterUser
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
     * @param  AddSite  $event
     * @return void
     */
    public function handle(AddSite $event)
    {
        //
    }
}
