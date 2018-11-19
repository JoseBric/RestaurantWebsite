<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Http\Resources\Dish as DishResource;
class DishesController extends Controller
{
    public function index()
    {
        $imgs = Dish::all();
        return DishResource::collection($imgs);
    }

    public function create()
    {
        $imgs = Dish::all();
        
        return view("admin")->with("imgs", $imgs);
    }

    public function store(Request $request)
    {
        $image = $request->file("file")->store(
            "menu",
            "s3"
        );
        Dish::create([
            "user_id" => $request->user()->id,
            "image" => $image,
        ]);
        return back();
    }

    public function show(Dish $dish)
    {
        return new DishResource($dish);
    }

    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy(Dish $dish)
    {
        if($dish->delete()){
            return new DishResource($dish);
        }
    }
}
