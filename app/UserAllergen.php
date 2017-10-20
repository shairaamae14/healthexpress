<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAllergen extends Model
{
    protected $table = 'user_allergens';
    protected $primaryKey = 'ua_id';
    protected $fillable = ['user_id','allergen_id', 'tolerance_level', 'status'];
    protected $dates = ['deleted_at'];
}
