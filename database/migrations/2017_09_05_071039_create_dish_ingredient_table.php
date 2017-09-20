<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_ingredients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ding_id');
            $table->integer('um_id')->unsigned();
            $table->integer('dish_id')->unsigned();
            $table->integer('ing_id')->unsigned();
            $table->integer('quantity');
            $table->string('preparation');
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('dish_ingredients', function (Blueprint $table) {
           $table->foreign('um_id')->references('um_id')->on('unit_measurements')->onDelete('cascade');
           $table->foreign('dish_id')->references('did')->on('dishes')->onDelete('cascade');
           $table->foreign('ing_id')->references('id')->on('ingredient_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dish_ingredients');
    }
}
