<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMCondition extends Model
{
    protected $table = 'user_medcondition';
    protected $fillable = ['user_id','medcon_id', 'status'];
    protected $dates = ['deleted_at'];
}
