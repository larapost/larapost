<?php

Route::group(['prefix' => 'larapost', 'namespace' => 'Larapost\app\Http\Controllers', 'middleware' => 'web'], function () {
    Route::get('/', 'LaraPostController@index')->name('larapost');
    
    Route::group(['prefix' => 'posts'], function(){
        Route::get('/all', 'PostsController@index')->name('larapost.posts.index');
        Route::get('/create', 'PostsController@create')->name('larapost.posts.create');
        Route::get('/all/edit/{id}', 'PostsController@edit')->name('larapost.posts.edit');
        Route::post('/store', 'PostsController@store')->name('larapost.posts.store');
        Route::put('/update/{id}', 'PostsController@update')->name('larapost.posts.update');
        Route::post('/delete/{id}', 'PostsController@delete')->name('larapost.posts.delete');
    });
});