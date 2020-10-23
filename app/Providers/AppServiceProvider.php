<?php

namespace LaravelForum\Providers;

use LaravelForum\Channel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //shareメソッドでviewとデータを共有することができる(viewでは変数$channelsで受け取る)
        View::share('channels', Channel::all());
    }
}
