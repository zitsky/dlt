<?php


namespace App\Models;


use Database\Factories\CustomerEmailFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerEmailModel extends Model
{
    use HasFactory;
    public $table = "customer_emails";
    public $fillable = ['default','email'];
    public $casts = ['default'=>'boolean'];

    protected static function newFactory()
    {
        return CustomerEmailFactory::new();
    }

    public function customer() {
        return $this->belongsTo(CustomerModel::class,"customer_id");
    }
}
