<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CookResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cook extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = ['email', 'password', 'first_name' , 'last_name','location','longitude', 
                            'latitude', 'contact_no', 'cook_status','status'];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['deleted_at'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CookResetPasswordNotification($token));
    }

    public function dish() {
        return $this->hasMany('App\Dish');
    }
    
    public function pm_dishes()
    {
        return $this->hasMany('App\Pmealdishes');
    }

    public function rating(){
        return $this->hasMany('App\CookRating', 'cook_id', 'id');
    }

      public function average(){
        return $this->hasOne('App\CookAverage', 'cook_id', 'id');
    }
}
