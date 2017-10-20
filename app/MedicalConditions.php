<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalConditions extends Model
{
    protected $table = 'medical_conditions';
    protected $primaryKey = 'medcon_id';
    protected $fillable = ['medcon_name', 'status'];
    protected $dates = ['deleted_at'];


    public function user() {
    	return $this->belongsToMany('App\User', 'user_medcondition', 'medcon_id', 'user_id');
    }

    public function restrictions() {
    	return $this->hasOne('App\MedicalRestrictions', 'mcon_id', 'medcon_id');
    }
}
