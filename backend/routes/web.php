<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return response()->json([
        "title" => "API Workorder [Coding Test]",
        "owner" => [
            "full_name" => "Nur Aria Hibnastiar",
            "link_linkedin" => "https://www.linkedin.com/in/hibnastiar/",
            "link_github" => "https://github.com/hibnastiar27",
        ]
    ]);
});
