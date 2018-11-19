<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DishesInfoRestriction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("dishes", function(Blueprint $table){
            $table->string("description", 150)->change();
            $table->string("name", 25)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("dishes", function(Blueprint $table){
            $table->string("description")->change();
            $table->string("name")->change();
        });
    }
}
