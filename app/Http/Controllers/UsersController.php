<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function profile(User $user){
        return view("user.profile")->with("user", $user);
    }
    public function settings(User $user){
        return view("user.settings")->with("user", $user);
    }
    public function updateSettings(Request $request, User $user) {
        $request->validate([
            "password" => "max:50|confirmed|min:6|nullable",
            "name" => "max:50|min:3|nullable",
        ]);
        $name = $request->input("name");
        $password = $request->input("password");
        $user->name = isset($name) ? $name : $user->name;
        $user->password = isset($password) ? Hash::make($password) : $user->password;
        $user->save();
    }
}
