<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMode extends Model
{
    protected $table = 'order_mode';
    protected $fillable = ['om_name'];

    public function order()
    {
    	return $this->hasOne('App\Order');
    }
}
