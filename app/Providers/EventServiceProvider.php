<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\AddSite' => [
            'App\Listeners\RegisterUser',
        ],
        'App\Events\AddNotice' => [
            'App\Listeners\TeamReject',
        ],
        'App\Events\getMsgCount' => [
            'App\Listeners\ReadNotice',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
