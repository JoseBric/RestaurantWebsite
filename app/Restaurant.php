<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function City() {
        return $this->belongsTo(City::class);
    }
}
