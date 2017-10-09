<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAttrToNullableToUsersAllergensMedconTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_allergens', function (Blueprint $table) {
            $table->integer('allergen_id')->nullable()->unsigned()->change();
            $table->string('tolerance_level')->nullable()->change();
        });
        Schema::table('user_medcondition', function (Blueprint $table) {
            $table->integer('medcon_id')->nullable()->unsigned()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_allergens', function (Blueprint $table) {
            //
        });
    }
}
