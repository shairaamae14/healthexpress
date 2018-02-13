<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookRating extends Model
{

       protected $table = 'cook_ratings';
        protected $fillable = ['uo_id', 'comment', 'rating', 'date_rate'];





}
