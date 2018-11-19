<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $guarded = [];
    public function Dishes() {
        $this->belongsToMany(Dish::class, "dishes_categories", "category_id", "dish_id");
    }
}
