<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cookPlan extends Model
{
   protected $table = 'cook_plan';
   protected $primaryKey = 'id';
    protected $fillable = ['dish_name','dish_id','cook_id','start_date', 'end_date'];
}
