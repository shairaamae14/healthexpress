<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientList extends Model
{
    protected $table = 'ingredient_list';
    protected $primaryKey = 'id';
    
    
    public function dish_ingredients() {
        return $this->belongsToMany('App\Dish', 'dish_ingredients', 'ing_id', 'dish_id');
    }
}
