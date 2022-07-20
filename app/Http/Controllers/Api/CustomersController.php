<?php


namespace App\Http\Controllers\Api;


use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Repositories\Interfaces\CustomersInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class CustomersController extends BaseApiController
{
    public function __construct(private CustomersInterface $repo)
    {
    }

    public function index(Request $request): JsonResponse {
        $page = max(0,$request->get("page",0));
        list($l,$items) = $this->repo->paged($page,20);
        return $this->success($items,["total"=>$l]);
    }

    public function show($id): JsonResponse {
        return $this->success($this->repo->show($id));
    }

    public function store(CreateCustomerRequest $request): JsonResponse {
        $this->repo->add($request->all());
        return $this->success();
    }

    public function update(UpdateCustomerRequest $request, $id): JsonResponse {
        $this->repo->update($id,$request->all());
        return $this->success();
    }

    public function destroy($id): JsonResponse {
        $this->repo->remove($id);
        return $this->success();
    }
}
