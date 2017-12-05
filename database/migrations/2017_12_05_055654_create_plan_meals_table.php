<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planned_meals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('user_id')->unsigned();
            $table->integer('om_id')->unsigned();
            $table->integer('dish_id')->unsigned();
            $table->integer('be_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->string('start_time');
            $table->string('end_time');
            $table->timestamps();
        });
        Schema::table('planned_meals', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('om_id')->references('id')->on('order_mode')->onDelete('cascade');
            $table->foreign('dish_id')->references('did')->on('dishes')->onDelete('cascade');
            $table->foreign('be_id')->references('be_id')->on('besteaten_at')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planned_meals');
    }
}
