<?php

use App\Article;
use Illuminate\Support\Facades\Log;
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

Route::get('/bulletin/{cat_id}', function ($cat_id) {
    $rows = Article::where('cat_id', '=', $cat_id)->paginate(10);

//    Log::info($cat_id);
    return view('bulletin_board', [
        'rows' => $rows
    ]);
});

Route::get('/article/{article_id}', function ($article_id) {
    $row = Article::where('id', '=', $article_id)->get();

    return view('article', [
        'row' => $row
    ]);
});

Route::post('/search/location/calc', 'SearchByLocationController@calc');

Route::get('image-upload', 'SearchByImageController@index')->name('image.upload');
Route::post('image-upload', 'SearchByImageController@upload')->name('image.upload.post');
