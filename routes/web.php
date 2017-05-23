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

Route::group(['prefix'=>'home'], function(){
    $controllerPrefix = "HomeController@";

    Route::get('', $controllerPrefix."index");
    Route::get('two', $controllerPrefix."two");  
    Route::get('three/{id?}', $controllerPrefix."three")->where(['id'=>'[a-zA-Z]+']);
    Route::get('form', $controllerPrefix."form");
    Route::post('form', $controllerPrefix."formpost");
    Route::get('response', $controllerPrefix."response");
    Route::get('profile', $controllerPrefix."profile");
    Route::get('session', $controllerPrefix."session");
    Route::get('ctvar', $controllerPrefix."ctvar");

    Route::get('/cache', function(){

        return Cache::get('key');
    });

    Route::get("cli", $controllerPrefix."cli");

    Route::get('event', $controllerPrefix."event");
});

Route::get('/common/index', 'CommonController@index')->name('common');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



