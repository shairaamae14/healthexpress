<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookAverage extends Model
{
   protected $table = 'cookrating_avg';
        protected $fillable = ['cook_id', 'average'];

    public function cook(){
    	return $this->belongsTo('App\Cook', 'cook_id', 'id');
    }
}
