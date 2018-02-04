<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToleranceValues extends Model
{
    protected $table = 'allergen_threshold';
    protected $fillable = ['aid', 'level', 'threshold_value', 'min', 'max'];

    public function allergens() {
    	return $this->belongsTo('App\Allergens', 'allergen_id', 'aid');
    }
}
