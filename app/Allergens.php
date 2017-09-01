<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergens extends Model
{
    protected $table = 'allergens';
    protected $fillable = ['allergen_name', 'status'];
    protected $dates = ['deleted_at'];
}
