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

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::prefix('user')->group(function(){
        Route::get('/index',[
            'uses'=>'UserController@index',
            'as' =>'admin.user.index'
        ]);
        Route::get('/add',[
            'uses'=>'UserController@getAdd',
            'as' =>'admin.user.add'
        ]);
        Route::post('/add',[
            'uses'=>'UserController@postAdd',
            'as' =>'admin.user.add'
        ]);
        Route::get('/edit/{id}',[
            'uses'=>'UserController@getEdit',
            'as' =>'admin.user.edit'
        ]);
        Route::post('/edit/{id}',[
            'uses'=>'UserController@postEdit',
            'as' =>'admin.user.edit'
        ]);
        Route::get('/del/{id}',[
            'uses'=>'UserController@del',
            'as' =>'admin.user.del'
        ]);
    });  
});
