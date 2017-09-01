<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAllergensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_allergens', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ua_id');
            $table->integer('user_id')->unsigned();
            $table->integer('allergen_id')->unsigned();
            $table->string('tolerance_level');
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::table('user_allergens', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('allergen_id')->references('allergen_id')->on('allergens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_allergens');
    }
}
