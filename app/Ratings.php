<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
       protected $table = 'dish_ratings';
        protected $fillable = ['uo_id', 'comment', 'rating'];
}
