<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishAverage extends Model
{
   protected $table = 'dishrating_avg';
        protected $fillable = ['average', 'dish_id'];


}
