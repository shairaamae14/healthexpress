<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergens extends Model
{
    protected $table = 'allergens';
    protected $primaryKey ='allergen_id';
    protected $fillable = ['allergen_name', 'status'];
    protected $dates = ['deleted_at'];


    public function user() {
    	return $this->belongsToMany('App\User', 'user_allergens', 'allergen_id', 'user_id');
    }

    public function tol_values() {
    	return $this->hasOne('App\ToleranceValues', 'aid', 'allergen_id');
    }
}
