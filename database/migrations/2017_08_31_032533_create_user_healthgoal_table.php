<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHealthgoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_healthgoals', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('uhg_id');
            $table->integer('hg_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('date_started');
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::table('user_healthgoals', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('hg_id')->references('hg_id')->on('health_goals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_healthgoals');
    }
}
