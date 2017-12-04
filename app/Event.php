<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['id', 'user_id', 'name', 'type' ,'start_date','end_date'];
}
