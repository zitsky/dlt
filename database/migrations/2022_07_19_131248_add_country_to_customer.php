<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryToCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $t) {
            $t->string("country_id",2)->nullable();
            $t->foreign("country_id")->references("id")->on("countries");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $t) {
            $t->dropForeign("customers_country_id_foreign");
            $t->dropColumn("country_id");
        });
    }
}
