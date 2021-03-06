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

Route::get('/', 'IndexController@page')->name('index');
Route::get('publications','PublicationsController@getIndex')->name('publications');

Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => config('artifico2.root_path'), 'middleware' => ['backend'], 'as' => 'admin.'], function () {
        Route::resource('publications', 'PublicationController');
        Route::get('/','Admin\IndexController@index');
    });
});

Route::group(['as' => 'pages.'], function () {
    Route::get('/{alias}', 'PagesController@page')
        ->name('page')
        ->where('alias', '.*');
});
