<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookCatalog extends Model
{
    protected $table = 'cook_dishcatalog';
    protected $fillable = ['cook_id', 'dish_id', 'isSignatureDish', 'status'];
    
    public function cook() {
        return $this->belongsTo('App\Cook', 'cook_id', 'id');
    }
    
}
