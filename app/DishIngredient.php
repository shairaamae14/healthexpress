<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishIngredient extends Model
{
    protected $table = 'dish_ingredients';
    protected $primaryKey = 'ding_id';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    
    
}
