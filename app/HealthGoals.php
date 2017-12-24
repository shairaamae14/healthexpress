<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthGoals extends Model
{
    protected $table = 'health_goals';
    protected $primaryKey = 'hg_id';
    protected $fillable = ['hgoal_name', 'description', 'status'];
    protected $dates = ['deleted_at'];
}
