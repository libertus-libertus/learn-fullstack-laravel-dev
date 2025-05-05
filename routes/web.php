<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware("auth")->group(function () {
    Route::get("user", [UserController::class, "index"])->name("user.index")->middleware("tokenvalid");

    Route::prefix("blog")->group(function () {
        Route::get("/", [BlogController::class, "index"])->name("blog.index")->middleware("tokenvalid2");
        Route::get("/create", [BlogController::class, "create"])->name("blog.create");
        Route::post("/", [BlogController::class, "store"])->name("blog.store");
        Route::get("/{blog}", [BlogController::class, "show"])->name("blog.show");
        Route::get("/{blog}/edit", [BlogController::class, "edit"])->name("blog.edit");
        Route::patch("/{blog}", [BlogController::class, "update"])->name("blog.update");
        Route::delete("/{blog}", [BlogController::class, "destroy"])->name("blog.destroy");
        Route::get("/{blog}/restore", [BlogController::class, "restore"])->name("blog.restore");
    });

    Route::post("comment/{blog_id}", [CommentController::class, "store"])->name("comment.store");
    #logout
    Route::get("logout", [AuthController::class, "logout"])->name("logout");
});

Route::middleware("guest")->group(function () {
    Route::get("login", [AuthController::class, "login"])->name("login");
    Route::post("login", [AuthController::class, "authenticate"])->name("authenticate");
});
