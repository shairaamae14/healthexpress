<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookDishCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cook_dishcatalog', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cdc_id');
            $table->integer('cook_id')->unsigned();
            $table->integer('dish_id')->unsigned();
            $table->integer('isSignatureDish');
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::table('cook_dishcatalog', function (Blueprint $table) {
           $table->foreign('cook_id')->references('id')->on('cooks')->onDelete('cascade');
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
        Schema::dropIfExists('cook_dishcatalog');
    }
}
