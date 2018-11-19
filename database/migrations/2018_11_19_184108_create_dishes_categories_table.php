<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes_categories', function (Blueprint $table) {
            $table->integer("dish_id")->unsigned();
            $table->integer("category_id")->unsigned();
            $table->primary(["dish_id", "category_id"]);
            $table->timestamps();
            $table->foreign("dish_id")
                ->references("id")
                ->on("dishes");
            $table->foreign("category_id")
                ->references("id")
                ->on("categories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes_categories');
    }
}
