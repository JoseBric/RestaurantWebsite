<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Category;
use Storage;
// use App\Http\Requests\DishRequest;

class DishesController extends Controller
{
    public function index()
    {
        $tags = Category::all();
        $dishes = Dish::orderBy("created_at", "desc")->paginate(9);
        $data = [
            "tags" => $tags,
            "dishes" => $dishes,
        ];
        return view("dish.dashboard")->with($data);
    }

    public function create()
    {
        $tags = Category::all();
        return view("dish.create")->with("tags", $tags);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            "category" => "nullable",
            "file" => "required",
            "description" => "required|max:150|min:3",
            "name" => "required|max:25",
        ]);
        
        $image = $request->file("file")->store(
            "menu",
            "s3"
        );
        $dish = Dish::create([
            "user_id" => $request->user()->id,
            "image" => $image,
            "description" => $request->input("description"),
            "name" => $request->input("name"),
        ]);
        $dish->categories()->attach($request->input("category"));
        return redirect("/dish");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tags = Category::all();
        $dish = Dish::find($id);
        $categories_id = [];
        foreach($dish->categories as $category){
            array_push($categories_id, $category->id);
        }
        $data = [
            "tags" => $tags,
            "dish" => $dish,
            "categories_id" => $categories_id,
        ];
        return view("dish.edit")->with($data);
    }

    public function update(Request $request, $id)
    {
        $dish = Dish::find($id);

        $request->validate([
            "category" => "nullable",
            "image" => "nullable",
            "description" => "max:150",
            "name" => "max:25",
        ]);
        
        $image = $request->file("file");
        if(empty($image)){
            $dish->description = $request->input("description");
            $dish->name = $request->input("name");
            $dish->save();
        } else {
            $image = $image->store("menu", "s3");
            Storage::disk("s3")->delete($dish->image);
            $dish->update([
                "description" => $request->input("description"),
                "image" => $image,
                "name" => $request->input("name"),
                ]);
            }
        $categories = $dish->categories()->sync($request->input("category"));
        return redirect("/dish")->with("success", "The dish has been updated");
    }

    public function destroy(Dish $dish)
    {
        Storage::disk("s3")->delete($dish->image);
        $dish->categories()->detach();
        $dish->delete();
    }
}
