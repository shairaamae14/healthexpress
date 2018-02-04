<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = ['om_id'];


    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function order_mode()
    {
    	return $this->hasOne('App\OrderMode', 'id', 'om_id');
    }

  
}
