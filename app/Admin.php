<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    
    protected $fillable = ['name', 'user_name'];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CookResetPasswordNotification($token));
    }

    public function dish() {
        return $this->hasMany('App\Dish');
    }
    
}
