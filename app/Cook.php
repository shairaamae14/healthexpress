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
    
}
