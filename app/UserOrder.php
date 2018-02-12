<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $primaryKey = 'uo_id';
    protected $fillable = ['user_id', 'order_id', 'payment_id', 'order_date', 'totalQty', 'totalAmount', 
                            'order_status', 'delivery_fee', 'sidenote', 'dish_name', 'planner_start', 
                            'planner_end','start', 'end', 'allDay', 'address', 'contact_no', 'mode_delivery',
                            'distance'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }


    public function orders()
    {
        return $this->belongsTo('App\Orders', 'order_id', 'id');
    }

    public function payment()
    {
    	return $this->belongsTo('App\PaymentMethod', 'payment_id', 'id');
    }
}
