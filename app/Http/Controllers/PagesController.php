<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Category;
use App\State;
use App\City;
use App\Restaurant;

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
        $states = State::all();
        return view("locations")->with("states", $states);
    }
    public function locations_admin(){
        $states = State::all();

        return view("locations_admin")->with("states", $states);
    }
    public function locations_store(Request $request){
        $request->validate([
            "state" => "required|max:50",
            "city" => "required|max:50",
            "street" => "required|max:100",
            "zipcode" => "required|max:5",
            "ext_num" => "required|max:10",
            "lat" => "required",
            "lng" => "required",
        ]);
        $stateName = strtolower($request->input("state"));
        $cityName = strtolower($request->input("city"));
        $street = strtolower($request->input("street"));
        $zipcode = $request->input("zipcode");
        $ext_num = strtolower($request->input("ext_num"));

        $lat = $request->input("lat");
        $lng = $request->input("lng");
        if(State::where("name", $stateName)->exists()) {
            $state = State::where("name", $stateName)->first();
            $city;
            if(City::where("name", $cityName)->exists()) {
                $city = City::where("name", $cityName)->first();
            } else {
                $city = City::create([
                    "name" => $cityName,
                    "state_id" => $state->id,
                ]);
            }
            $restaurant = Restaurant::create([
                "street" => $street,
                "zip_code" => $zipcode,
                "ext_num" => $ext_num,
                "city_id" => $city->id,
                "latitude" => $lat,
                "longitude" => $lng,
            ]);

        } else {
            $state = State::create([
                "name" => $stateName,
            ]);
            $city = City::create([
                "name" => $cityName,
                "state_id" => $state->id,
            ]);
            $restaurant = Restaurant::create([
                "street" => $street,
                "zip_code" => $zipcode,
                "ext_num" => $ext_num,
                "city_id" => $city->id,
                "latitude" => $lat,
                "longitude" => $lng,
            ]);
        }
        return back();
    }

    public function getCities(State $state) {
        $cities = $state->Cities;
        return $cities;
    }
    public function getRestaurants(City $city) {
        $restaurants = $city->Restaurants;
        return $restaurants;
    }
}
