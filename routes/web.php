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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/vc', 'HomeController@video_category')->name('vc');
Route::get('/search/{pageToken?}', 'HomeController@search')->name('search');
Route::get('/videos/{pageToken?}', 'HomeController@videos')->name('videos');
Route::get('/channels/{id?}', 'HomeController@channels')->name('channels');

Route::prefix('cronjob')->group(function(){
    Route::get('/get_video_category', 'CronjobController@get_video_category')->name('get_video_category');
});

