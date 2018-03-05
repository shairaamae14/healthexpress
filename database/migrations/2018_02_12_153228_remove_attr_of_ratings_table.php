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
            $table->dropColumn(['dr_id']);
        });
       

        Schema::table('cook_ratings', function (Blueprint $table) {
        $table->dropColumn(['cr_id']);
       
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
