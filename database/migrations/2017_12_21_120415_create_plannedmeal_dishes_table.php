<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlannedmealDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pm_dishes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cook_id')->unsigned();
            $table->integer('dish_id')->unsigned();     
            $table->string('plan');
            $table->timestamps();
        });
          Schema::table('pm_dishes', function (Blueprint $table) {
            $table->foreign('dish_id')->references('did')->on('dishes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
