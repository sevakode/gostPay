<?php

namespace App\Providers;

use App\Models\Bank\Card;
use App\Observers\CardObserver;
use App\Repository\Eloquent\wahahaResource\ProductDishWahahaRepository;
use App\Repository\Interfaces\ProductRepository;
use App\Services\NotesCardDirectory;
use App\Services\NotesCardService;
use Illuminate\Support\Facades\App;
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
        $this->app->bind(NotesCardDirectory::class, NotesCardService::class);
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
