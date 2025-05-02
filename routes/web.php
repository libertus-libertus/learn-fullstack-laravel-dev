<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * Route::resource:
 * 
 * GET
 * POST
 * PUT/PACTH
 * UPDATE
 * DESTROY
*/ 
Route::resource("blog", BlogController::class);
Route::get("blog/{blog}/restore", [BlogController::class, "restore"])->name("blog.restore");

Route::get("user", [UserController::class, "index"])->name("user.index");
Route::post("comment/{blog_id}", [CommentController::class, "store"])->name("comment.store");