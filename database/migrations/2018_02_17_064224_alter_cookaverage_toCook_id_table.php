<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCookaverageToCookIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('cook_ratings', function (Blueprint $table) {
            $table->integer('cook_id')->unsigned();

          });
           Schema::table('cookrating_avg', function (Blueprint $table) {
            $table->dropColumn(['cr_id']);
            $table->dropColumn(['dish_id']);
            $table->integer('cook_id')->unsigned();
        });

            Schema::table('dishrating_avg', function (Blueprint $table) {
            $table->dropColumn(['dr_id']);
        
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
