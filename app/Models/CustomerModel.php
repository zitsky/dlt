<?php


namespace App\Models;


use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;
    public $table = "customers";
    public $fillable = ['first_name','last_name','created_at','country_id'];

    protected static function newFactory()
    {
        return CustomerFactory::new();
    }

    public function emailsRelation() {
        return $this->hasMany(CustomerEmailModel::class,"customer_id");
    }

    public function websitesRelation() {
        return $this->hasMany(CustomerWebsiteModel::class,"customer_id");
    }

    public function countryRelation() {
        return $this->belongsTo(CountryModel::class, "country_id");
    }

    public function paymentsRelation() {
        return $this->hasMany(PaymentModel::class, "customer_id");
    }
}
