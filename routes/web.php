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
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
})->name('main')->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/search/location', 'SearchByLocationController@index')->name('search_by_location');
Route::get('/search/image', 'SearchByImageController@index')->name('search_by_image');

Route::post('/search/location/calc', 'SearchByLocationController@calc');
