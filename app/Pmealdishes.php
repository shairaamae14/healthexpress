<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pmealdishes extends Model
{
    protected $table= 'pm_dishes';
    protected $fillable = ['cook_id','dish_id','plan'];
}
