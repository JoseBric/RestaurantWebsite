<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Category;

class PagesController extends Controller
{
    public function home(){
        $dishes = Dish::where("featured", true)->get();
        return view("home")->with("dishes", $dishes);
    }
    public function menu(){
        $categories = Category::orderBy("category_name", "asc")->get();
        return view("menu")->with("categories", $categories);
    }
    public function menu_category($category){
        $category = Category::where("category_name", $category)->first();
        $dishes = $category->dishes;
        return view("menu_category")->with("dishes", $dishes);
    }
    public function menu_single($slug){
        $dish = Dish::where("name", $slug)->first();
        return view("menu_category")->with("dish", $dish);
    }
    public function about_us(){
        return view("about_us");
    }
    public function locations(){
        return view("locations");
    }
}
