<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $guarded = [];

    public function User(){
        $this->belongsTo(User::class);
    }

    public function Categories(){
        $this->hasMany(Category::class);
    }
}
