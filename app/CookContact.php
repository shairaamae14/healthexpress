<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookContact extends Model
{
    protected $table = 'cook_contacts';
    protected $fillable = ['cook_id', 'contact_number', 'contact_detail','isPrimary','status'];
    protected $dates = ['deleted_at'];
}
