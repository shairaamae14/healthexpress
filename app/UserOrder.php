<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $fillable = ['user_id', 'order_id', 'payment_id', 'dish_id',
                            'order_date', 'totalQty', 'totalAmount', 'order_status', 'delivery_fee'];
}
