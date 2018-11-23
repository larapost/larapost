<?php

Route::group(['prefix' => 'larapost', 'namespace' => 'Larapost\app\Http\Controllers'], function () {
    Route::get('/', 'LaraPostController@index')->name('larapost');
});