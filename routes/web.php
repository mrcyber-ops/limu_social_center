<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::group(['middleware' => ['auth']], function () {
    // Route::get('posts', [PostController::class, 'index'])->name('post.index');
    // Route::post('posts/store', [PostController::class, 'store'])->name('post.store');
    Route::resource('posts', PostController::class);


    Route::post('posts/like/{post}/{user}', [PostLikeController::class, 'toggleLike'])->name('posts.likes');
});


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
