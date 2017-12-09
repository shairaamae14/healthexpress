<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlannedMeals extends Model
{
    protected $table = 'planned_meals';
    protected $primaryKey = 'id';
    protected $fillable = ['title','user_id','om_id','dish_id','be_id','plan_id','start','end','allDay'];


}
