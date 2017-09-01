<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishBestEaten extends Model
{
    protected $table = 'dish_bestEaten';
    protected $fillable = ['dish_id', 'be_id', 'status'];
    protected $dates = ['deleted_at'];
}
