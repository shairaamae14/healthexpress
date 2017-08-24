<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $guard = ['id'];


    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function o_details() {
    	return $this->hasMany('App\OrderDetails');
    }
}
