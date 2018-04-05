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

Route::get('/', 'MainController@show')->name('home');

Route::get('/category/create', ['middleware' => 'auth', 'uses' => 'CategoryController@create'])->name('category.create');
Route::post('/category/create', ['middleware' => 'auth', 'uses' => 'CategoryController@postCreate'])->name('category.postCreate');
Route::get('/category', ['middleware' => 'auth', 'uses' => 'CategoryController@show'])->name('category.show');
Route::get('/category/{id}/edit', ['middleware' => 'auth', 'uses' => 'CategoryController@edit'])->name('category.edit');
Route::post('/category/{id}/save', ['middleware' => 'auth', 'uses' => 'CategoryController@save'])->name('category.save');
Route::post('/category/{id}/delete', ['middleware' => 'auth', 'uses' => 'CategoryController@delete']);
Route::post('/deletePhotoCategory', ['middleware' => 'auth', 'uses' => 'CategoryController@deletePhoto']);
Route::get('/category/{slug}', 'CategoryController@get');

Route::get('/items/create', ['middleware' => 'auth', 'uses' => 'ItemController@create'])->name('item.create');
Route::post('/items/create', ['middleware' => 'auth', 'uses' => 'ItemController@postCreate'])->name('item.postCreate');
Route::get('/items/{id}/edit', ['middleware' => 'auth', 'uses' => 'ItemController@edit']);
Route::post('/items/{id}/save', ['middleware' => 'auth', 'uses' => 'ItemController@save']);
Route::post('/items/{id}/delete', ['middleware' => 'auth', 'uses' => 'ItemController@delete']);
Route::get('/items', ['middleware' => 'auth', 'uses' => 'ItemController@show'])->name('item.show');
Route::post('/deletePhotoItem', ['middleware' => 'auth', 'uses' => 'ItemController@deletePhoto']);

Route::get('/setting/home', ['middleware' => 'auth', 'uses' => 'SettingController@home'])->name('setting.home');
Route::post('/setting/home', ['middleware' => 'auth', 'uses' => 'SettingController@save']);

Auth::routes();

Route::get('/home', 'OrderController@show');

Route::post('/addOrder', 'OrderController@add');
Route::post('/visit', 'OrderController@visit');
