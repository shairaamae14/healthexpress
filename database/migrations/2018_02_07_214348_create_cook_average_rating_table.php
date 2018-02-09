<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookAverageRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('cookrating_avg', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cook_id')->unsigned();
            $table->integer('average')->nullable();
            $table->timestamps();
        });

          Schema::table('cookrating_avg', function (Blueprint $table) {
            $table->foreign('cook_id')->references('id')->on('cooks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('cookrating_avg');
    }
}
