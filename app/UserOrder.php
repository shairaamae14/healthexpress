<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $primaryKey = 'uo_id';
    protected $fillable = ['user_id', 'order_id', 'payment_id', 'dish_id',
                        'order_date', 'totalQty', 'totalAmount', 'order_status', 'delivery_fee'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function dishes()
    {
    	return $this->hasMany('App\Dish', 'did', 'dish_id');
    }

    public function order()
    {
    	return $this->belongsTo('App\Orders', 'order_id');
    }

    public function payment()
    {
    	return $this->belongsTo('App\PaymentMethod', 'payment_id', 'id');
    }
}
