<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlannedMeals extends Model
{
    protected $table = 'planned_meals';
    protected $primaryKey = 'pm_id';
    protected $fillable = ['title','user_id','om_id','dish_id','be_id','plan_id','p_status','start','end','allDay','note','order_status','mode_delivery', 'address'];


    public function dishes()
    {
    	return $this->hasMany('App\Dish', 'dish_id', 'did');
    }

    public function user() 
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
}
