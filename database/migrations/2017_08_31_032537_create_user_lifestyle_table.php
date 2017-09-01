<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLifestyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_lifestyle', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ulstyleID');
            $table->integer('user_id')->unsigned();
            $table->integer('lifestyle_id')->unsigned();
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::table('user_lifestyle', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('lifestyle_id')->references('lifestyle_id')->on('lifestyles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_lifestyle');
    }
}
