<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $guarded = [];
    
    public function dishes() {
        return $this->belongsToMany(Dish::class, "categories_dishes", "category_id", "dish_id");
    }
}
