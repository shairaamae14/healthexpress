<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAttrOfRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dish_ratings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['dish_id']);
            $table->dropColumn(['user_id', 'dish_id']);
            $table->integer('uorder_id')->unsigned();
        });
        Schema::table('dish_ratings', function (Blueprint $table) {
            $table->foreign('uorder_id')->references('uo_id')->on('user_orders')->onDelete('cascade');
        });

        Schema::table('cook_ratings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['cook_id']);
            $table->dropColumn(['user_id', 'cook_id']);
            $table->integer('uorder_id')->unsigned();
        });
        Schema::table('cook_ratings', function (Blueprint $table) {
            $table->foreign('uorder_id')->references('uo_id')->on('user_orders')->onDelete('cascade');
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
            //
        });
    }
}
