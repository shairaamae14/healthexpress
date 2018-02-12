<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('dish_id')->unsigned();
            $table->float('price', 8,2);
            $table->integer('quantity');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('dish_id')->references('did')->on('dishes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            Schema::dropIfExists('orders');
        });
    }
}
