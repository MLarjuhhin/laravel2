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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//prefix to url blog/....
//namespase to folder
Route::group(['namespace'=>'App\Http\Controllers\Blog','prefix'=>'blog'],function (){
    Route::resource('posts',PostController::class)->names('blog.post');
});


//Admin

$groupData=[
  'namespace'=>'App\Http\Controllers\Blog\Admin',
    'prefix'=>'admin/blog'
];
Route::group($groupData,function (){
   $methods=['index','edit','update','create','store'];
   Route::resource('categoies',\App\Http\Controllers\Blog\Admin\CategoryController::class)
       ->only($methods)
       ->names('blog.admin.categoies');
});

//Route::resource('rest',\App\Http\Controllers\RestTestController::class)->names('restTest');




