<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lifestyles extends Model
{
    protected $table = 'lifestyles';
    protected $fillable = ['lifestyle_name', 'description', 'status'];
    protected $dates = ['deleted_at'];
}

