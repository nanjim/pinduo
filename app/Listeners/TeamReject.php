<?php

namespace App\Listeners;

use App\Events\AddNotice;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeamReject
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
     * @param  AddNotice  $event
     * @return void
     */
    public function handle(AddNotice $event)
    {
        //
    }
}
