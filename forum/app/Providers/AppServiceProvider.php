<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
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
        //on declare l'endroit ou on veut Utiliser le ViewComposer
        view()->composer(['posts.sidebar'], ActivityComposer::class);

        // on peut specifier qu'il s'affiche dans tous les view 
        // a l'aide de l'operator *
        # view()->composer('*', ActivityComposer::class);
    }
}
