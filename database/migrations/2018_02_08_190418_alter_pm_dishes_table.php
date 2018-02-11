<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPmDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pm_dishes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('dish_name');
            $table->decimal('basePrice', 10,2);
            $table->decimal('sellingPrice', 10,2);
            $table->text('dish_desc');
            $table->text('dish_img');
            $table->string('preparation_time');
            $table->integer('no_of_servings');
            $table->integer('status');
            $table->softDeletes();
            $table->dropColumn('plan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pm_dishes', function (Blueprint $table) {
            //
        });
    }
}
