<?php

namespace Database\Seeders;

use App\Models\CustomerEmailModel;
use App\Models\CustomerModel;
use App\Models\CustomerWebsiteModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Customers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("customers")->delete();
        $l = 50;
        for($i=0;$i<$l;$i++) {
            printf("$i\n");
            CustomerModel::factory(10000)->create();
//            ->each(function (CustomerModel $customer) {
//                CustomerEmailModel::factory(1)->create(['customer_id'=>$customer->id]);
//                CustomerWebsiteModel::factory(1)->create(['customer_id'=>$customer->id]);
//            });
        }
    }
}
