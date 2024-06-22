<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
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

Route::get('users',[UserController::class,'index'])->name('user.index');
Route::get('users/create',[UserController::class,'create'])->name('user.create');
Route::post('users/',[UserController::class,'store'])->name('user.store');
