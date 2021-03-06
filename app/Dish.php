<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Dish extends Model
{
    protected $table= 'dishes';
    protected $primaryKey = 'did';
    protected $fillable = ['authorCook_id','dish_name','basePrice', 'sellingPrice', 'dish_desc', 'dish_img',
        'preparation_time','no_of_servings', 'status'];
    protected $dates = ['deleted_at'];
    
    public function cook() {
    	return $this->belongsTo('App\Cook', 'authorCook_id', 'id');
    }
    
    public function besteaten() {
        return $this->belongsToMany('App\BestEaten', 'dish_besteaten', 'dish_id', 'be_id');
    }
    
    public function ingredients() {
        return $this->belongsToMany('App\IngredientList', 'dish_ingredients', 'dish_id', 'ing_id');
    }

    public function nfacts() {
        return $this->hasOne('App\NutritionFacts', 'ding_id', 'did');
    }
    
    public function user_orders()
    {
        return $this->hasMany('App\UserOrder', 'did', 'dish_id');
    }

    public function average(){
        return $this->hasOne('App\DishAverage', 'dish_id', 'did');
    }

    public function user()
    {
        return $this->belongsToMany('App\User', 'user_orders', 'user_id', 'dish_id');
    }
    
}
