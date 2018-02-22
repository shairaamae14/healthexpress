<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $primaryKey = 'uo_id';
    protected $fillable = ['user_id', 'order_id', 'payment_id', 'order_date', 'totalQty', 'totalAmount', 
                            'order_status', 'delivery_fee', 'sidenote', 'title', 'planner_start', 
                            'planner_end','start', 'end', 'allDay', 'address', 'contact_no', 'mode_delivery', 'distance', 'om_id', 'dish_id', 'longitude', 'latitude','cook_id'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function dishes()
    {
        return $this->belongsTo('App\Dish', 'dish_id', 'did');
    }

    public function payment()
    {
    	return $this->belongsTo('App\PaymentMethod', 'payment_id', 'id');
    }

    public function order_mode()
    {
        return $this->belongsTo('App\OrderMode', 'om_id', 'id');
    }
}
