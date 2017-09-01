<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHGoals extends Model
{
    protected $table = 'user_healthgoals';
    protected $fillable = ['hg_id','user_id', 'date_started', 'status'];
    protected $dates = ['deleted_at'];
}
