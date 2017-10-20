<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lifestyles extends Model
{
    protected $table = 'lifestyles';
    protected $primaryKey ='lifestyle_id';
    protected $fillable = ['lifestyle_name', 'description', 'status'];
    protected $dates = ['deleted_at'];

    protected function user() {
    	return $this->belongsToMany('App\User', 'user_lifestyle', 'lifestyle_id', 'user_id');
    }
}

