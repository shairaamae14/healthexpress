<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
	protected $table= 'dishes';
    protected $guard = ['cook_id'];
    protected $fillable = array('cook_id','dish_name','dish_category','dish_price','dish_desc','dish_img','dish_leadTime','serving_size');

    public function cook() {
    	return $this->belongsTo('App\User');
    }
}
