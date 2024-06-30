<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('tests',[TestController::class,'index'])->name('tests.index');
Route::post('tests/upload',[TestController::class, 'upload'])->name('tests.upload');

Route::get('login',[LoginController::class,'loginShow'])->name('login.index');
Route::get('register',[RegisterController::class,'registerShow'])->name('register.index');
Route::post('register/',[RegisterController::class,'store'])->name('login.store');
Route::post('login',[LoginController::class,'login'])->name('user.login');
Route::middleware('auth')->group(function(){
    Route::get('admin',[AdminController::class,'adminShow'])->name('admin.index');
    Route::delete('admin/{id}',[AdminController::class,'delete'])->name('admin.delete');
    Route::get('users/file',[FileController::class,'index'])->name('file.index');
});

Route::middleware('auth')->group(function () {
Route::post('users/file', [FileController::class,'store'])->name('file.store');
Route::delete('users/file/{id}', [FileController::class, 'delete'])->name('file.delete');
});
