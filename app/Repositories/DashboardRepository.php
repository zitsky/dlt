<?php


namespace App\Repositories;


use App\Exceptions\InvalidDateException;
use App\Models\CustomerModel;
use App\Models\PaymentModel;
use App\Repositories\Interfaces\DashboardInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardRepository implements DashboardInterface
{
    public function customersPerDay(Carbon $from, Carbon $to): Collection
    {
        $this->validateDate($from, $to);
        $q = CustomerModel::query();
        $q->groupByRaw("DATE(created_at)");
        $q->selectRaw("DATE(created_at) as d, COUNT(*) as c");
        $q->whereBetween("created_at", [$from, $to]);
        return $q->get()->pluck("c", "d")->reduce(function (Collection $base, $item, $key) {
            $base[$key] = $item;
            return $base;
        }, $this->fillDates($from, $to))->reduce(function (Collection $base, $item, $key) {
            $base->push(['key' => $key, 'val' => $item]);
            return $base;
        }, collect());
    }

    public function customersPerWeek($from, $to): Collection
    {
        $this->validateDate($from, $to);
        $q = CustomerModel::query();
        $q->groupByRaw("DATE_FORMAT(created_at,'%Y-%v')");
        $q->selectRaw("DATE_FORMAT(created_at,'%Y-%v') as d, COUNT(*) as c");
        $q->whereBetween("created_at", [$from, $to]);
        return $q->get()->pluck("c", "d")->reduce(function (Collection $base, $item, $key) {
            $base[$key] = $item;
            return $base;
        }, $this->fillWeeks($from, $to))->reduce(function (Collection $base, $item, $key) {
            $base->push(['key' => $key, 'val' => $item]);
            return $base;
        }, collect());
    }

    public function customersPerMonth($from, $to): Collection
    {
        $this->validateDate($from, $to);
        $q = CustomerModel::query();
        $q->groupByRaw("DATE_FORMAT(created_at,'%Y-%m')");
        $q->selectRaw("DATE_FORMAT(created_at,'%Y-%m') as d, COUNT(*) as c");
        $q->whereBetween("created_at", [$from, $to]);
        return $q->get()->pluck("c", "d")->reduce(function (Collection $base, $item, $key) {
            $base[$key] = $item;
            return $base;
        }, $this->fillMonths($from, $to))->reduce(function (Collection $base, $item, $key) {
            $base->push(['key' => $key, 'val' => $item]);
            return $base;
        }, collect());
    }

    public function paymentsPerDay($from, $to): Collection
    {
        $this->validateDate($from, $to);
        $q = PaymentModel::query();
        $q->groupByRaw("DATE(created_at)");
        $q->selectRaw("DATE(created_at) as d, SUM(cost) as c");
        $q->whereBetween("created_at", [$from, $to]);
        return $q->get()->pluck("c", "d")->reduce(function (Collection $base, $item, $key) {
            $base[$key] = $item;
            return $base;
        }, $this->fillDates($from, $to))->reduce(function (Collection $base, $item, $key) {
            $base->push(['key' => $key, 'val' => round($item / 100, 2)]);
            return $base;
        }, collect());
    }

    public function paymentsPerWeek($from, $to): Collection
    {
        $this->validateDate($from, $to);
        $q = PaymentModel::query();
        $q->groupByRaw("DATE_FORMAT(created_at,'%Y-%v')");
        $q->selectRaw("DATE_FORMAT(created_at,'%Y-%v') as d, COUNT(*) as c");
        $q->whereBetween("created_at", [$from, $to]);
        return $q->get()->pluck("c", "d")->reduce(function (Collection $base, $item, $key) {
            $base[$key] = $item;
            return $base;
        }, $this->fillWeeks($from, $to))->reduce(function (Collection $base, $item, $key) {
            $base->push(['key' => $key, 'val' => round($item / 100, 2)]);
            return $base;
        }, collect());
    }

    public function paymentsPerMonth($from, $to): Collection
    {
        $this->validateDate($from, $to);
        $q = PaymentModel::query();
        $q->groupByRaw("DATE_FORMAT(created_at,'%Y-%m')");
        $q->selectRaw("DATE_FORMAT(created_at,'%Y-%m') as d, COUNT(*) as c");
        $q->whereBetween("created_at", [$from, $to]);
        return $q->get()->pluck("c", "d")->reduce(function (Collection $base, $item, $key) {
            $base[$key] = $item;
            return $base;
        }, $this->fillMonths($from, $to))->reduce(function (Collection $base, $item, $key) {
            $base->push(['key' => $key, 'val' => round($item / 100, 2)]);
            return $base;
        }, collect());
    }

    private function validateDate(Carbon $from, Carbon $to)
    {
        if (!$from->isValid() || !$to->isValid() || $from->greaterThan(Carbon::now()) || $to->greaterThan(Carbon::now()) || $from->greaterThan($to)) {
            throw new InvalidDateException();
        }
    }

    private function fillDates(Carbon $from, Carbon $to): Collection
    {
        $i = $from->clone()->startOfDay();
        $e = $to->clone()->startOfDay()->add(1, 'day');
        $dates = collect();
        for (; !$e->eq($i); $i->add(1, 'day')) {
            $dates[$i->toDateString()] = 0;
        }
        return $dates;
    }

    private function fillWeeks(Carbon $from, Carbon $to): Collection
    {
        $i = $from->clone()->startOfMonth();
        $e = $to->clone()->endOfMonth()->addWeek();
        $dates = collect();
        for (; !$e->lessThanOrEqualTo($i); $i->addWeek()) {
            $dates[$i->format("Y-W")] = 0;
        }
        return $dates;
    }

    private function fillMonths(Carbon $from, Carbon $to): Collection
    {
        $i = $from->clone()->startOfMonth();
        $e = $to->clone()->startOfMonth()->add(1, 'month');
        $dates = collect();
        for (; !$e->eq($i); $i->add(1, 'month')) {
            $dates[$i->format("Y-m")] = 0;
        }
        return $dates;
    }

}
