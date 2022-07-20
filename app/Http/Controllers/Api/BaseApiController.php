<?php


namespace App\Http\Controllers\Api;


use Illuminate\Routing\Controller;

class BaseApiController extends Controller
{
    protected function success($data = [],$mix = []): \Illuminate\Http\JsonResponse
    {
        return response()->json(['success'=>true,'data'=>$data,...$mix]);
    }
}
