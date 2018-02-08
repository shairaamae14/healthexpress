<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishAverage extends Model
{
   protected $table = 'dishrating_avg';
        protected $fillable = ['dish_id', 'average'];

    public function dishes(){
    	return $this->belongsTo('App\Dish', 'dish_id', 'did');
    }
}
