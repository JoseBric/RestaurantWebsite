<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        return view("home");
    }
    public function menu(){
        return view("menu");
    }
    public function about_us(){
        return view("about_us");
    }
    public function schedules(){
        return view("schedules");
    }
}
