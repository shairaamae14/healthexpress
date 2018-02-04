<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NutritionFacts extends Model
{
    protected $table = 'nutritional_facts';
    protected $fillable = ['ding_id', 'gram_weight', 'calories', 'protein', 'total_fat',
						'carbohydrate', 'fibre', 'sodium', 'sat_fat', 'cholesterol'];

	public function dish() {
		return $this->belongsTo('App\Dish', 'ding_id', 'did');
	}
}
