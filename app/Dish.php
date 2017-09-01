<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Dish extends Model
{
    protected $table= 'dishes';
    protected $guard = ['cook_id'];
    protected $fillable = ['cook_id','dish_name', 'status'];
    protected $dates = ['deleted_at'];
    public function cook() {
    	return $this->belongsTo('App\Cook');
    }
    
    public function dish_details(){
        return $this->hasMany('App\DishDetail', 'dish_id', 'id');
    }
}
