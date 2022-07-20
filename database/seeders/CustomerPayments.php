<?php

namespace Database\Seeders;

use App\Models\CustomerEmailModel;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CustomerPayments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("payments")->delete();
        $ids = [];
        for($i=0;$i<500000;$i++) {
            $l = rand(1,5);
            for($k=0;$k<$l;$k++) {
                $ids[] = $i;
            }
        }
        $ids = Arr::shuffle($ids);
        $faker = Factory::create();
        $total = sizeof($ids);
        $current = 0;
        foreach ($ids as $id) {
            printf("%d of %d\n",++$current, $total);
            DB::table("payments")->insert([
                'customer_id'=>$id,
                'created_at'=>$faker->dateTimeBetween('-1 year'),
                'cost'=>$faker->numberBetween(100,100000)
            ]);
        }
    }
}
