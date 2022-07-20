<?php


namespace App\Http\Controllers\Api;


use App\Repositories\Interfaces\CountriesInterface;
use Illuminate\Http\JsonResponse;

class CountriesController extends BaseApiController
{
    public function __construct(private CountriesInterface $repo)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success($this->repo->all());
    }
}
