<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalConditions extends Model
{
    protected $table = 'medical_conditions';
    protected $fillable = ['medcon_name', 'status'];
    protected $dates = ['deleted_at'];
}
