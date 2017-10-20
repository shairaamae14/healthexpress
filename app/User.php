<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;
class User extends Authenticatable
{
    use Notifiable;
    use Billable;
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

    public function allergies() {
        return $this->belongsToMany('App\Allergens', 'user_allergens', 'user_id', 'allergen_id');
    }

    public function conditions() {
        return $this->belongsToMany('App\MedicalConditions', 'user_medcondition', 'user_id', 'medcon_id');
    }

    public function lifestyle() {
        return $this->belongsToMany('App\Lifestyles', 'user_lifestyle', 'user_id', 'lifestyle_id');
    }
}
