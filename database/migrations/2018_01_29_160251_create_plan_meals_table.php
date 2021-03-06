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
            $table->increments('pm_id');
            $table->string('title');
            $table->integer('user_id')->unsigned();
            $table->integer('om_id')->unsigned();
            $table->integer('dish_id')->unsigned();
            $table->integer('be_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->string('p_status');
            $table->string('start');
            $table->string('end');
            $table->string('allDay');
            $table->string('note')->nullable();
            $table->string('order_status');
            $table->string('mode_delivery');
            $table->string('address');
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
