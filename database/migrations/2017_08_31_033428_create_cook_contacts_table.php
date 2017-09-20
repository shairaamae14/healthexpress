<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cook_contacts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cc_id');
            $table->integer('cook_id')->unsigned();
            $table->string('contact_number');
            $table->string('contact_detail');
            $table->integer('isPrimary');
            $table->integer('status');
            $table->timestamps();
        });
        Schema::table('cook_contacts', function (Blueprint $table) {
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
        Schema::dropIfExists('cook_contacts');
    }
}
