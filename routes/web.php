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


Auth::routes();

Route::post('/c','CommentController@store');
Route::post('following/{user}','FollowsController@store');
Route::get('user/following/{user}','FollowingController@myfollowing');
Route::get('user/followers/{user}','FollowingController@myfollowers');
Route::get('/', 'PostController@index');
Route::get('/p/create','PostController@create');
Route::get('/p/{post}','PostController@show');
Route::get('/profile/image/{user}','ProfilesController@image');
Route::post('/p','PostController@store');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/search/{words}', 'ProfilesController@search');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
Route::get('/c/delete/{comment}', 'CommentController@destroy')->name('comment.delete');
