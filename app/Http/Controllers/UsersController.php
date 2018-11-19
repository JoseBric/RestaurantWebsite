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
            "password" => "max:50|confirmed|min:6",
            "name" => "max:50|min:3",
        ]);
        User::find($user->id)->update([
            "password" => Hash::make($request->input("password")),
            "name" => $request->input("name"),
        ]);
        return back()->with("success", "Your settings have been updated!");
    }
}
