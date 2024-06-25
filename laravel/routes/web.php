<?php

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

Route::get('users',[UserController::class,'index'])->name('user.index');
Route::get('users/create',[UserController::class,'create'])->name('user.create');
Route::post('users/',[UserController::class,'store'])->name('user.store');


Route::get('users/file',[FileController::class,'index'])->name('file.index');
Route::post('users/file', [FileController::class,'store'])->name('file.store');
Route::post('users/file', [FileController::class, 'delete'])->name('file.delete');
