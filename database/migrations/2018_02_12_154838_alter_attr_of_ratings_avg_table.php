<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAttrOfRatingsAvgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cookrating_avg', function (Blueprint $table) {
            $table->dropForeign(['cook_id']);
            $table->dropColumn(['cook_id']);
            $table->integer('cr_id')->unsigned();
        });

        Schema::table('cookrating_avg', function (Blueprint $table) {
            $table->foreign('cr_id')->references('id')->on('cook_ratings')->onDelete('cascade');
        });

        Schema::table('dishrating_avg', function (Blueprint $table) {
            $table->dropForeign(['dish_id']);
            $table->dropColumn(['dish_id']);
            $table->integer('dr_id')->unsigned();
        });

        Schema::table('dishrating_avg', function (Blueprint $table) {
            $table->foreign('dr_id')->references('id')->on('dish_ratings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cookrating_avg', function (Blueprint $table) {
            //
        });
    }
}
