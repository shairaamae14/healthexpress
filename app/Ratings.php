<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
       protected $table = 'dish_ratings';
        protected $fillable = ['comment', 'rating', 'date_rated', 'uorder_id', 'dish_id' ];
}
