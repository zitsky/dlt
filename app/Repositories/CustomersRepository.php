<?php


namespace App\Repositories;


use App\Models\CustomerEmailModel;
use App\Models\CustomerModel;
use App\Models\CustomerWebsiteModel;
use App\Repositories\Interfaces\CustomersInterface;
use Cassandra\Custom;
use Illuminate\Support\Facades\DB;

class CustomersRepository implements CustomersInterface
{
    public function paged($page, $per = 20)
    {
        $q = CustomerModel::query();
        $l = $q->count();
        $q->with(['emailsRelation','websitesRelation','countryRelation']);
        $q->limit($per);
        $q->offset(max($page-1,0) * $per);
        return [$l,$q->get()->map(function(CustomerModel $item) {
            $emails = $item->emailsRelation->pluck("email")->join(", ");;
            $websites = $item->websitesRelation->pluck("website")->join(", ");
            $item->websites = $websites;
            $item->emails = $emails;
            $item->country = $item->countryRelation->name ?? "-";
            unset($item->emailsRelation);
            unset($item->websitesRelation);
            return $item;
        })];
    }

    public function remove($id)
    {
        $model = CustomerModel::find($id);
        if($model) {
            DB::transaction(function() use($model) {
                $model->emailsRelation()->delete();
                $model->websitesRelation()->delete();
                $model->paymentsRelation()->delete();
                $model->delete();
            });
        }
        return true;
    }

    public function add($fields)
    {
        $model = CustomerModel::create($fields);
        $emails=[];
        $websites=[];
        foreach ($fields['websites'] as $website) {
            $websites[] = CustomerWebsiteModel::make($website);
        }

        foreach ($fields['emails'] as $email) {
            $emails[] = CustomerEmailModel::make($email);
        }

        $model->emailsRelation()->saveMany($emails);
        $model->websitesRelation()->saveMany($websites);
    }

    public function update($id, $fields)
    {
        $model = CustomerModel::find($id);
        $model->fill($fields);
        $model->save();
        $model->emailsRelation()->delete();
        $model->websitesRelation()->delete();
        $emails=[];
        $websites=[];
        foreach ($fields['websites'] as $website) {
            $websites[] = CustomerWebsiteModel::make($website);
        }

        foreach ($fields['emails'] as $email) {
            $emails[] = CustomerEmailModel::make($email);
        }

        $model->emailsRelation()->saveMany($emails);
        $model->websitesRelation()->saveMany($websites);
    }

    public function show($id) {
        $model = CustomerModel::find($id);
        $model->websites = $model->websitesRelation;
        $model->emails = $model->emailsRelation;
        $model->country_name = $model->countryRelation->name;
        unset($model->websitesRelation);
        unset($model->emailsRelation);
        return $model;
    }


}
