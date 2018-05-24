<?php

Route::get('/', 'TaskssController@index');

Route::resource('tasks', 'TasksController');



Route::get('/', function () {
    return view('welcome');
});
