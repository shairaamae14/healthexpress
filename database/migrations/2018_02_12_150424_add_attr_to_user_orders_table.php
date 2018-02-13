<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttrToUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_orders', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->date('planner_start')->nullable();
            $table->date('planner_end')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('allDay')->nullable();
            $table->string('address');
            $table->string('contact_no', 11);
            $table->string('mode_delivery');
            $table->float('distance', 8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_orders', function (Blueprint $table) {
            //
        });
    }
}
