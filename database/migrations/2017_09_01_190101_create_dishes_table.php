<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('did');
            $table->integer('authorCook_id')->unsigned(); 
            $table->string('dish_name');
            $table->decimal('basePrice', 10,2);
            $table->decimal('sellingPrice', 10,2);
            $table->text('dish_desc');
            $table->text('dish_img');
            $table->time('preparation_time');
            $table->integer('serving_size');
            $table->integer('no_of_servings');
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::table('dishes', function (Blueprint $table) {
           $table->foreign('authorCook_id')->references('id')->on('cooks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
}
