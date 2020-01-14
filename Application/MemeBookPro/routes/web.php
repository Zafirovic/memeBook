<?php

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

Route::get('/welcome', 'MemeController@index1')->name('home1');
Route::middleware(['auth'])->group(function (){
   Route::get('/','MemeController@index')->name('home');
   Route::get('/memes/create','MemeController@create')->name('create.meme');
   Route::post('/memes/store','MemeController@store')->name('store.meme');
   Route::get('/category/follow/{category_id}','MemeController@follow')->name('category.follow');
   Route::get('/category/unfollow/{category_id}','MemeController@unfollow')->name('category.unfollow');
});

Route::get('/notifications', 'HomeController@notifications')->name('notifications');
Route::get('/meme-single/{meme}','MemeController@single')->name('single.meme');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

