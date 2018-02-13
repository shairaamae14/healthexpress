<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookAverage extends Model
{
   protected $table = 'cookrating_avg';
        protected $fillable = ['cook_id', 'average'];

     public function rating(){
   	return $this->hasMany('App\CookRating', 'id', 'cr_id');
   }
}
