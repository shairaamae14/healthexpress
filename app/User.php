<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname','lname', 'email', 'password', 'contact_no', 'weight', 'height', 'birthday','gender', 'health_goal',
        'allergens', 'medical_condition', 'lifestyle', 'location', 'longitude', 'latitude', 'status' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
    ];
    
    protected $dates = ['deleted_at'];
     public function orders() {
        return $this->hasMany('App/Orders');
    }
}
