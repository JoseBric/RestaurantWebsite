<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Category;
use Storage;
// use App\Http\Requests\DishRequest;

class AdminPagesController extends Controller
{
    public function index()
    {
        $dishes = Dish::all();
        $tags = Category::all();
        $data = [
            "dishes" => $dishes,
            "tags" => $tags,
        ];
        return view("admin.admin")->with($data);
    }

    public function create()
    {
        return view("admin.create");

    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            "file" => "required",
            "description" => "required|max:150|min:3",
            "name" => "required|max:25",
        ]);

        $image = $request->file("file")->store(
            "menu",
            "s3"
        );
        Dish::create([
            "user_id" => $request->user()->id,
            "image" => $image,
            "description" => $request->input("description"),
            "name" => $request->input("name"),
        ]);
        return redirect("/admin");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dish = Dish::find($id);
        return view("admin.edit")->with("dish", $dish);
    }

    public function update(Request $request, $id)
    {
        // return "hello";
        $dish = Dish::find($id);

        $request->validate([
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
        return redirect("/admin")->with("success", "The dish has been updated");
    }

    public function destroy($id)
    {
        $dish = Dish::find($id);
        Storage::disk("s3")->delete($dish->image);
        if($dish->delete()){
            return back();
        }
    }
}
