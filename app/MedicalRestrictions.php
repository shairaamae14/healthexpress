<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRestrictions extends Model
{
    protected $table = 'medconres';
    protected $fillable = ['mcon_id', 'Energ_Kcal', 'Protein_g', 'Lipid_Tot_g', 'Ash_g',
							'Carbohydrt_g', 'Fiber_TD_g', 'Sugar_Tot_g', 'Calcium_mg',
							'Iron_mg', 'Magnesium_mg', 'Phosphorus_mg', 'Potassium_mg',
							'Sodium_mg', 'Zinc_mg', 'Copper_mg', 'Manganese_mg',
							'Selenium_µg', 'Vit_C_mg', 'Thiamin_mg', 'Riboflavin_mg',
							'Niacin_mg', 'Panto_Acid_mg', 'Vit_B6_mg', 'Vit_B6_mg',
							'Folate_Tot_µg', 'Folic_Acid_µg', 'Food_Folate_µg' ,
							'Folate_DFE_µg', 'Choline_Tot_mg', 'Choline_Tot_mg',
							'Vit_B12_µg', 'Vit_B12_µg', 'Vit_A_IU', 'Vit_A_RAE',
							'Retinol_µg', 'Alpha_Carot_µg', 'Beta_Carot_µg', 
							'Beta_Crypt_µg', 'Lycopene_µg', 'LutZea_µg', 'Vit_E_mg',
							'Vit_D_µg', 'Vit_D_IU', 'Vit_K_µg', 'FA_Sat_g',
							'FA_Mono_g', 'FA_Poly_g', 'Cholestrl_mg', 'status'];


	public function condition() {
		return $this->belongsTo('App\MedicalConditions', 'mcon_id', 'medcon_id');
	}
}
