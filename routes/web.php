<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
    Hello world he hello
|h*/
// note something
Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'admin'],function (){
    Route::group(['prefix'=>'contact'],function (){
        Route::get('table','ContactController@table')->name('contact.table');
        Route::get('create','ContactController@getCreate');
        Route::post('create','ContactController@postCreate')->name('contact.create');
        Route::get('update/{id}','ContactController@getUpdate');
        Route::post('update/{id}','ContactController@postUpdate')->name('contact.update');
        Route::get('delete/{id}','ContactController@getDestroy');
    });
});
