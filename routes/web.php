<?php

Route::get('/', 'TasksController@index');
Route::resource('tasks', 'TasksController');
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
Route::group(['middleware' => ['auth']], function () {Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
});



