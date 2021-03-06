<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMedconditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_medcondition', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('umedconID');
            $table->integer('user_id')->unsigned();
            $table->integer('medcon_id')->unsigned();
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::table('user_medcondition', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('medcon_id')->references('medcon_id')->on('medical_conditions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_medcondition');
    }
}
