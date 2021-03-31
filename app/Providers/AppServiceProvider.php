<?php

namespace App\Providers;

use App\Models\Bank\Card;
use App\Observers\CardObserver;
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
        Card::observe(CardObserver::class);
    }
}
