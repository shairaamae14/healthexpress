<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Dish extends Model
{
    protected $table= 'dishes';
    protected $fillable = ['authorCook_id','dish_name','basePrice', 'sellingPrice', 'dish_desc', 'dish_img',
        'preparation_time','no_of_servings', 'status'];
    protected $dates = ['deleted_at'];
    
    public function cook() {
    	return $this->belongsTo('App\Cook', 'authorCook_id', 'id');
    }
    
    
}
