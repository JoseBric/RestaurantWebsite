<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Http\Resources\Dish as DishResource;
use Storage;
class DishesApiController extends Controller
{
    public function index()
    {
        $imgs = Dish::all();
        return DishResource::collection($imgs);
    }

    public function show(Dish $dish)
    {
        return new DishResource($dish);
    }
}
