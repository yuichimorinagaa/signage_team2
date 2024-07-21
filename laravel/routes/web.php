<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SignageController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\NewsController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the0 "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
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
    Route::delete('admin/file/{id}', [AdminController::class,'deleteFile'])->name('admin.deleteFile');
    Route::get('users/file',[FileController::class,'index'])->name('file.index');
    Route::get('admin/select',[AdminController::class,'select'])->name('admin.select');
});


Route::middleware('auth')->group(function () {
Route::delete('users/file/{id}', [FileController::class, 'delete'])->name('file.delete');
Route::post('users/file', [FileController::class,'store'])->name('file.store');
Route::post('users/file/select', [FileController::class, 'selectFiles'])->name('file.select');
Route::post('users/file/change', [FileController::class, 'statusChange'])->name('file.statusChange');
Route::get('users/preview', [PreviewController::class, 'index'])->name('preview.index');
Route::post('users/preview/update',[PreviewController::class, 'update'])->name('preview.update');
Route::post('users/preview/back',[PreviewController::class, 'back'])->name('preview.backToUpload');
Route::post('logout',[LoginController::class,'logout'])->name('logout');
});

Route::get('profiles/index',[ProfileController::class,'index'])->name('profiles.index');
Route::get('profiles/form',[ProfileController::class,'showForm'])->name('profiles.showForm');
Route::post('profiles/form/store', [ProfileController::class, 'store'])->name('profiles.store');
Route::get('profiles/form/thanks', [ProfileController::class, 'thanks'])->name('profiles.thanks');

Route::get('users/testApi', [UserController::class, 'index'])-> name('testApi');
Route::get('/api/weather', [UserController::class, 'fetchWeather'])->name('fetch.weather');


Route::get('users/newsApi',[NewsController::class, 'index'])-> name('newsApi');
Route::get('/api/news', [NewsController::class, 'fetchNews'])->name('fetch.news');


Route::get('profiles/indexTwo',[ProfileController::class,'indexTwo'])->name('profiles.index2');

Route::get('signage' ,[SignageController::class,'index'])->name('signage.index');
Route::get('success',[SignageController::class,'success'])->name('success');
Route::get('signage/weatherApi',[SignageController::class,'fetchWeather'])->name('signage.fetchWeather');
Route::get('signage/news',[SignageController::class,'fetchNews'])->name('signage.fetchNews');
