<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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

Route::middleware("auth")->group(function () {
    Route::get("user", [UserController::class, "index"])->name("user.index");
    
    Route::resource("blog", BlogController::class);
    Route::get("blog/{blog}/restore", [BlogController::class, "restore"])->name("blog.restore");
    Route::post("comment/{blog_id}", [CommentController::class, "store"])->name("comment.store");

    #logout
    Route::get("logout", [AuthController::class, "logout"])->name("logout");
});

Route::middleware("guest")->group(function () {
    Route::get("login", [AuthController::class, "login"])->name("login");
    Route::post("login", [AuthController::class, "authenticate"])->name("authenticate");
});