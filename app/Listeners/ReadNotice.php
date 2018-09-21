<?php

namespace App\Listeners;

use App\Events\getMsgCount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReadNotice
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
     * @param  getMsgCount  $event
     * @return void
     */
    public function handle(getMsgCount $event)
    {
        //
    }
}
