<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Organization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $org = Organization::first();
        view()->share('boot_org',$org);
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
