<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_details';
    protected $fillable = ['payment_method', 'delivery_charge','quantity', 'total_amount'];

    public function order() {
    	return $this->belongsTo('App\Orders', 'order_id');
    }

    public function dish() {
    	return $this->hasMany('App\Dish', 'dish_id');
    }
}