<?php

use App\Http\Controllers\BlogController;
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
Route::resource('blog', BlogController::class);
Route::get('blog/{blog}/restore', [BlogController::class, 'restore'])->name('blog.restore');