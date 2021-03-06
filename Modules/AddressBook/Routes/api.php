<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('contacts','API\ContactsController');
Route::resource('groups','API\GroupsController');
Route::resource('tags','API\TagsController');

Route::post('contacts/{contact}/action-favorite','API\ContactsController@actionFavorite');
