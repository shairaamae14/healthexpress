<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BestEaten extends Model
{
    protected $table = 'bestEaten_at';
    protected $fillable = ['name','start_time', 'end_time', 'status'];
    protected $dates = ['deleted_at'];
}
