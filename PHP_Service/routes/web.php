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

Route::resource('user', 'Admin\\UsersController');
Route::resource('filter', 'Admin\\FiltersController');
Route::resource('wishlist-item', 'Admin\\WishlistItemController');
Route::get('products','Api\\ProductsController@index');