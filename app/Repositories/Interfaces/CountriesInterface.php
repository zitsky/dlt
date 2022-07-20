<?php


namespace App\Repositories\Interfaces;


use Illuminate\Support\Collection;

interface CountriesInterface
{
    public function all(): Collection;
}
