<?php

namespace App\Http\Controllers\Api;


use App\Models\CustomerModel;
use App\Repositories\Interfaces\DashboardInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DashboardCustomersController extends BaseApiController
{
    public function __construct(private DashboardInterface $repo)
    {
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $from = Carbon::parse($request->get("from"));
        $to = Carbon::parse($request->get("to"));
        $slice = $request->get("slice", "day");
        switch ($slice) {
            case "day":
                return $this->success($this->repo->customersPerDay($from, $to));
            case "week":
                return $this->success($this->repo->customersPerWeek($from, $to));
            case "month":
                return $this->success($this->repo->customersPerMonth($from, $to));
        }
        throw new NotFoundHttpException();
    }
}
