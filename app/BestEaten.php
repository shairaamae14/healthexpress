<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BestEaten extends Model
{
    protected $table = 'bestEaten_at';
    protected $primaryKey = 'be_id';
    protected $fillable = ['name','start_time', 'end_time', 'status'];
    protected $dates = ['deleted_at'];
    
    public function dish() {
    	return $this->belongsToMany('App\Dish', 'dish_besteaten', 'be_id', 'dish_id');
    }
}
