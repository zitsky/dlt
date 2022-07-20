<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    public $table = 'payments';
    public $fillable = ['customer_id', 'cost', 'created_at'];

    public function customerRelation()
    {
        return $this->belongsTo(CustomerModel::class, "customer_id");
    }
}
