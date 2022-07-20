<?php

namespace Database\Seeders;

use App\Models\CustomerEmailModel;
use App\Models\CustomerWebsiteModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CustomerWebsites extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = [];
        for($i=0;$i<500000;$i++) {
            $ids[] = $i;
        }
        $ids = Arr::shuffle($ids);
        $total = sizeof($ids);
        $current = 0;
        foreach ($ids as $id) {
            printf("%d of %d\n",++$current, $total);
            CustomerWebsiteModel::factory(1)->create(['customer_id'=>$id]);
        }
    }
}
