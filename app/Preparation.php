<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preparation extends Model
{
    protected $table = 'preparations';
    protected $primaryKey = 'p_id';
    protected $fillable = ['p_name', 'status'];
}
