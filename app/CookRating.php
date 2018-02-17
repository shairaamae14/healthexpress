<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookRating extends Model
{

       protected $table = 'cook_ratings';
        protected $fillable = ['comment', 'rating', 'date_rate', 'uorder_id', 'dish_id', 'cook_id'];





}
