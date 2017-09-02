<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NDB_No');
            $table->string('Shrt_Desc');
            $table->string('Water_g');
            $table->string('Energ_Kcal');
            $table->string('Protein_g');
            $table->string('Lipid_Tot_g');
            $table->string('Ash_g');
            $table->string('Carbohydrt_g');
            $table->string('Fiber_TD_g');
            $table->string('Sugar_Tot_g');
            $table->string('Calcium_mg');
            $table->string('Iron_mg');
            $table->string('Magnesium_mg');
            $table->string('Phosphorus_mg');
            $table->string('Potassium_mg');
            $table->string('Sodium_mg');
            $table->string('Zinc_mg');
            $table->string('Copper_mg');
            $table->string('Manganese_mg');
            $table->string('Selenium_µg');
            $table->string('Vit_C_mg');
            $table->string('Thiamin_mg');
            $table->string('Riboflavin_mg');
            $table->string('Niacin_mg');
            $table->string('Panto_Acid_mg');
            $table->string('Vit_B6_mg');
            $table->string('Folate_Tot_µg');
            $table->string('Folic_Acid_µg');
            $table->string('Food_Folate_µg');
            $table->string('Folate_DFE_µg');
            $table->string('Choline_Tot_mg');
            $table->string('Vit_B12_µg');
            $table->string('Vit_A_IU');
            $table->string('Vit_A_RAE');
            $table->string('Retinol_µg');
            $table->string('Alpha_Carot_µg');
            $table->string('Beta_Carot_µg');
            $table->string('Beta_Crypt_µg');
            $table->string('Lycopene_µg');
            $table->string('LutZea_µg');
            $table->string('Vit_E_mg');
            $table->string('Vit_D_µg');
            $table->string('Vit_D_IU');
            $table->string('Vit_K_µg');
            $table->string('FA_Sat_g');
            $table->string('FA_Mono_g');
            $table->string('FA_Poly_g');
            $table->string('Cholestrl_mg');
            $table->string('GmWt_1');
            $table->string('GmWt_Desc1');
            $table->string('GmWt_2');
            $table->string('GmWt_Desc2');
            $table->string('Refuse_Pct');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_list');
    }
}
