<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//prefix to url blog/....
//namespase to folder
Route::group(['namespace'=>'App\Http\Controllers\Blog','prefix'=>'blog'],function (){
    Route::resource('posts',PostController::class)->names('blog.post');
});


//Route::resource('rest',\App\Http\Controllers\RestTestController::class)->names('restTest');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
