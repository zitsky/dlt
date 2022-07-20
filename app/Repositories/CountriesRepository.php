<?php


namespace App\Repositories;


use App\Models\CountryModel;
use App\Repositories\Interfaces\CountriesInterface;
use Illuminate\Support\Collection;

class CountriesRepository implements CountriesInterface
{
    public function all(): Collection
    {
        return CountryModel::orderBy("name", "Asc")->get();
    }
}
