<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookRating extends Model
{

       protected $table = 'cook_ratings';
        protected $fillable = ['user_id','cook_id', 'comment', 'rating', 'date_rate'];

     public function cook() {
    	return $this->belongsTo('App\Cook', 'cook_id', 'id');
    }

      public function user() {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }



}
