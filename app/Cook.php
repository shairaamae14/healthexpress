<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CookResetPasswordNotification;
class Cook extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['email', 'password', 'first_name' , 'last_name',
                         'location','longitude', 'latitude', 'contact_no',
                         'status'];

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
