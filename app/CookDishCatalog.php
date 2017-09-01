<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookDishCatalog extends Model
{
    protected $table = 'cook_dishcatalog';
    protected $fillable = ['cook_id', 'dish_id', 'isSignatureDish', 'status'];
    protected $dates = ['deleted_at'];
}
