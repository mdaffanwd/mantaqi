<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/', [PostController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });

// Resourceful routes for posts
Route::resource('posts', PostController::class)
    ->only([
        'index',   // GET    /posts
        'create',  // GET    /posts/create
        'store',   // POST   /posts
        'show',    // GET    /posts/{post}
        'edit',    // GET    /posts/{post}/edit
        'update',  // PUT    /posts/{post}
        'destroy', // DELETE /posts/{post}
    ]);