<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLifestyle extends Model
{
    protected $table = 'user_lifestyle';
    protected $primaryKey = 'ulstyleID';
    protected $fillable = ['user_id','lifestyle_id', 'status'];
    protected $dates = ['deleted_at'];
}
