<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\OrganisationCities\OrganisationCityInterface::class,
            \App\Repositories\OrganisationCities\OrganisationCityRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Roles\RoleInterface::class,
            \App\Repositories\Roles\RoleEloquent::class
        );

        $this->app->singleton(
            \App\Repositories\ShipmentTypes\ShipmentTypeInterface::class,
            \App\Repositories\ShipmentTypes\ShipmentTypeEloquent::class
        );

        $this->app->singleton(
            \App\Repositories\ConfirmType\ConfirmTypeInterface::class,
            \App\Repositories\ConfirmType\ConfirmTypeEloquent::class
        );
    }
}
