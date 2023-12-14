<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class,'show'])->name('login');
Route::post('/login', [LoginController::class,'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/user/index', [UserController::class,'index'])->name('user.index');
    Route::get('/user/create', [UserController::class,'create'])->name('user.create');
    Route::post('/user/store', [UserController::class,'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class,'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class,'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class,'delete'])->name('user.delete');

    Route::get('/post/index', [PostController::class,'index'])->name('post.index');
    Route::get('/post/create', [PostController::class,'create'])->name('post.create');
    Route::post('/post/store', [PostController::class,'store'])->name('post.store');
    Route::get('/post/edit/{id}', [PostController::class,'edit'])->name('post.edit');
    Route::post('/post/update/{id}', [PostController::class,'update'])->name('post.update');
    Route::delete('/post/delete/{id}', [PostController::class,'delete'])->name('post.delete');
});
