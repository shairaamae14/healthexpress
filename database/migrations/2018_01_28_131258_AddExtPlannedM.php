<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtPlannedM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planned_meals', function (Blueprint $table) {
            $table->integer('contact_no');
             $table->integer('distance')->nullable();
            $table->integer('del_charge');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     Schema::table('planned_meals', function (Blueprint $table) {
               $table->integer('contact_no');
             $table->integer('distance');
            $table->integer('del_charge');
        });
    }
}
