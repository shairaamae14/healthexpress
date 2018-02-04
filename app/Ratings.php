<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
       protected $table = 'dish_ratings';
        protected $fillable = ['user_id','dish_id', 'comment', 'rating'];
}
