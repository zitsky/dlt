<?php


namespace App\Http\Controllers\Api;


use App\Repositories\Interfaces\PaymentsInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentsController extends BaseApiController
{
    public function __construct(private PaymentsInterface $repo)
    {
    }

    public function index(Request $request): JsonResponse {
        $page = max(0,$request->get("page",0));
        list($l,$items) = $this->repo->paged($page,20);
        return $this->success($items,["total"=>$l]);
    }
}
