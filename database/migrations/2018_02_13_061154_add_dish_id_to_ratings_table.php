<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDishIdToRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dish_ratings', function (Blueprint $table) {
            $table->integer('dish_id')->unsigned();
        });

        Schema::table('cook_ratings', function (Blueprint $table) {
            $table->integer('dish_id')->unsigned();
        });

        Schema::table('cookrating_avg', function (Blueprint $table) {
            $table->integer('dish_id')->unsigned();
        });
        Schema::table('dishrating_avg', function (Blueprint $table) {
            $table->integer('dish_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dish_ratings', function (Blueprint $table) {
            $table->dropColumn('dish_id');
        });
        Schema::table('cook_ratings', function (Blueprint $table) {
            $table->dropColumn('dish_id');
        });

        Schema::table('cookrating_avg', function (Blueprint $table) {
            $table->dropColumn('dish_id');
        });
        Schema::table('dishrating_avg', function (Blueprint $table) {
            $table->dropColumn('dish_id');
        });
    }
}
