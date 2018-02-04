<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pmealdishes extends Model
{
    protected $table= 'pm_dishes';
    protected $fillable = ['cook_id','dish_id','plan'];

    public function dishes()
    {
    	return $this->belongsTo('App\Dish', 'did', 'dish_id');
    }

    public function cook()
    {
    	return $this->belongsTo('App\Cook', 'cook_id');
    }
}
