<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookRating extends Model
{

       protected $table = 'cook_ratings';
        protected $fillable = ['user_id','cook_id', 'comment', 'rating', 'date_rate'];

}
