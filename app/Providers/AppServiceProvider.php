<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\messages;
use App\Webhook;
use App\Twitter;
use App\instagram;
use App\Observers\MessageObserver;
use App\Observers\WebhookObserver;
use App\Observers\TwitterObserver;
use App\Observers\InstagramObserver;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        messages::observe(MessageObserver::class);
        Webhook::observe(WebhookObserver::class);
        Twitter::observe(TwitterObserver::class);
        instagram::observe(InstagramObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
