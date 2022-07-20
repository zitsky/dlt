<?php


namespace App\Models;


use Database\Factories\CustomerWebsiteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerWebsiteModel extends Model
{
    use HasFactory;
    public $table = 'customer_websites';
    public $fillable = ['website','default'];
    public $casts = ['default'=>'boolean'];

    protected static function newFactory()
    {
        return CustomerWebsiteFactory::new();
    }

    public function customer() {
        return $this->belongsTo(CustomerModel::class,"customer_id");
    }
}
