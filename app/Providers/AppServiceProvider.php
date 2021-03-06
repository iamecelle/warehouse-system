<?php

namespace App\Providers;
use App\Section, App\Product, App\Locations;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()

    {
        //
        Schema::defaultStringLength(191);
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
