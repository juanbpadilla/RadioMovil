<?php

use App\Jobs\SendEmail;

DB::listen(function($query){
    // echo "<pre>{$query->sql}</pre>";
});

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

Route::resource('mensajes', 'MessagesController');

Route::resource('usuarios', 'UsersController');

Route::resource('pasajeros', 'PassangerController');

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@ShowLoginForm']);

Route::post('login', 'Auth\LoginController@Login');

Route::get('logout', 'Auth\LoginController@logout');

