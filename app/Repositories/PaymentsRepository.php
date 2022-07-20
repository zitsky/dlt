<?php


namespace App\Repositories;


use App\Models\PaymentModel;
use App\Repositories\Interfaces\PaymentsInterface;

class PaymentsRepository implements PaymentsInterface
{
    public function paged($page, $per)
    {
        $q = PaymentModel::query();
        $l = $q->count();
        $q->with(['customerRelation']);
        $q->orderBy("created_at","DESC");
        $q->limit($per);
        $q->offset(max($page-1,0) * $per);
        return [$l,$q->get()->map(function(PaymentModel $item) {
            $item->cost = round($item->cost/100,2);
            $item->date = $item->created_at->format("d.m.Y");
            $item->customer = sprintf("%s %s",$item->customerRelation->first_name,$item->customerRelation->last_name);
            $item->customer_id = $item->customerRelation->id;
            unset($item->customerRelation);
            return $item;
        })];
    }

}
