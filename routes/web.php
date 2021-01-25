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

Route::middleware(['web','auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('avatar','ImageController@getDefaultAvatar');
    Route::post('api/upload_image','ImageController@upload');
});

