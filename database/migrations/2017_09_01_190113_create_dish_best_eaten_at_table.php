<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishBestEatenAtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_bestEaten', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('dbe_id');
            $table->integer('dish_id')->unsigned();
            $table->integer('be_id')->unsigned();
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::table('dish_bestEaten', function (Blueprint $table) {
           $table->foreign('dish_id')->references('did')->on('dishes');
           $table->foreign('be_id')->references('be_id')->on('bestEaten_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dish_bestEaten');
    }
}
