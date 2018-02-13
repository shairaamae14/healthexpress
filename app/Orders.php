<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = ['om_id', 'dish_id', 'price', 'quantity'];


    public function dishes() {
    	return $this->belongsTo('App\Dish', 'dish_id', 'did');
    }

    public function order_mode()
    {
    	return $this->belongsTo('App\OrderMode', 'om_id', 'id');
    }

    public function user_orders()
    {
    	return $this->hasMany('App\UserOrder', 'order_id', 'id');
    }
  
}
