<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function Restaurants() {
        return $this->hasMany(Restaurant::class);
    }
    public function State() {
        return $this->belongsTo(State::class);
    }
}
