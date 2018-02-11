<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteDishidFromPmDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pm_dishes', function (Blueprint $table) {
            $table->dropForeign(['dish_id']);
            $table->dropColumn('dish_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pm_dishes', function (Blueprint $table) {
           $table->integer('dish_id')->unsigned();
        });
        Schema::table('pm_dishes', function (Blueprint $table) {
            $table->foreign('dish_id')->references('did')->on('dishes')->onDelete('cascade');

        });
    }
}
