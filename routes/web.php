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

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('tasks', 'TaskController');

Auth::routes();

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('profile/edit', 'ProfileController@edit')->name('profile-edit');
Route::put('profile/{profile}', 'ProfileController@update');
Route::get('profile/{profile}', 'ProfileController@show')->middleware('auth');
