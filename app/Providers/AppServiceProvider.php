<?php

namespace App\Providers;

use App\Repositories\CountriesRepository;
use App\Repositories\CustomersRepository;
use App\Repositories\DashboardRepository;
use App\Repositories\Interfaces\CountriesInterface;
use App\Repositories\Interfaces\CustomersInterface;
use App\Repositories\Interfaces\DashboardInterface;
use App\Repositories\Interfaces\PaymentsInterface;
use App\Repositories\PaymentsRepository;
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
        $this->app->bind(DashboardInterface::class, DashboardRepository::class);
        $this->app->bind(CountriesInterface::class, CountriesRepository::class);
        $this->app->bind(CustomersInterface::class, CustomersRepository::class);
        $this->app->bind(PaymentsInterface::class, PaymentsRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
