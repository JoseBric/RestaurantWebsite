<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenusAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("menus", function(Blueprint $table){
            $table->string("description");
            $table->string("name");
            $table->integer("user_id")->unsigned()->nullable()->change();
        });
        Schema::rename("menus", "dishes");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("dishes", function(Blueprint $table){
            $table->dropColumn("description");
            $table->dropColumn("name");
            $table->integer("user_id")->unsigned()->nullable(false)->change();
        });
        Schema::rename("dishes", "menus");
    }
}
