<?php

namespace App\Providers;

use App\lib\tools\FooBar;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
//    protected $defer = true;
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('testfoo',function(){
            return new FooBar();
        });
    }

//    function provides()
//    {
//        return FooBar::class;
//    }
}
