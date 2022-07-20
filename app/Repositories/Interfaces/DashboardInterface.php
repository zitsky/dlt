<?php


namespace App\Repositories\Interfaces;


use Carbon\Carbon;
use Illuminate\Support\Collection;

interface DashboardInterface
{
    public function customersPerDay(Carbon $from, Carbon $to): Collection;

    public function customersPerWeek(Carbon $from, Carbon $to): Collection;

    public function customersPerMonth(Carbon $from, Carbon $to): Collection;

    public function paymentsPerDay(Carbon $from, Carbon $to): Collection;

    public function paymentsPerWeek(Carbon $from, Carbon $to): Collection;

    public function paymentsPerMonth(Carbon $from, Carbon $to): Collection;
}
