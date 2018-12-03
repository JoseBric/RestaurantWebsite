<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, "categories_dishes", "dish_id", "category_id");
    }
    
    public function featured(){
        return $this->update(["featured" => true]);
    }
    
    public function unfeatured(){
        return $this->update(["featured" => false]);
    }   
}
