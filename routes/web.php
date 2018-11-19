<?php
Route::get('/', "PagesController@home");
Route::get('/menu', "PagesController@menu");
Route::get('/about_us', "PagesController@about_us");
Route::get('/schedules', "PagesController@schedule");
Route::resource("/admin", "AdminPagesController")->middleware("auth");
Route::resource("/admin/category", "CategoriesController")->middleware("auth");

Route::get("/user/{user}", "UsersController@profile");
Route::get("/user/{user}/settings", "UsersController@settings")->middleware("auth_me");
Route::post("/user/{user}/update", "UsersController@updateSettings")->middleware("auth_me")->name("update_user_settings");
Auth::routes();