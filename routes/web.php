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

Route::group(['prefix' => 'admin', 'namespace' => 'Backend\Controllers'],function() {
    
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', 'LoginController@index');
        Route::post('login', 'LoginController@login');
    });

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/','HomeController@index');
        
        //文章区
        Route::group(['prefix' => 'article'], function() {
            Route::get('/create','ArticleController@create');
            Route::post('/create','ArticleController@store');
            Route::get('/list','ArticleController@list');
        });

        Route::group(['prefix' => 'category'], function() {
            Route::get('/','Category@index');
            
        });
        
        
        
        Route::get('logout','HomeController@logout');
        
    });
});