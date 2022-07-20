<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomersWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("customer_websites", function (Blueprint $t) {
            $t->unsignedBigInteger("id",true);
            $t->unsignedBigInteger("customer_id")->index();
            $t->string("website",512)->index()->unique();
            $t->boolean("default")->default(false);
            $t->timestamps();

            $t->foreign("customer_id")->on("customers")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("customer_websites");
    }
}
