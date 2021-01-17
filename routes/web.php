<?php

// Route::get('test', function(){
//     $user =new App\User;
//     $user->nombre = 'Dimar';
//     $user->apellido = 'Coca';
//     $user->sexo = 'Hombre';
//     $user->direccion = 'Barrio Guadalupe donde mueren los valientes';
//     $user->telefono = '110';
//     $user->email = 'dimar@email.com';
//     $user->user_name = 'dimar1';
//     $user->password = bcrypt('123123');
//     $user->save();

//     return $user;
// });

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

Route::get('saludos/{nombre?}', ['as' => 'saludos', 'uses' => 'PagesController@saludo']);

// Route::get('contactos', ['as' => 'contactos', 'uses' => 'PagesController@contacto']);


Route::resource('mensajes', 'MessagesController');


Route::get('login', 'Auth\LoginController@ShowLoginForm');
Route::post('login', 'Auth\LoginController@Login');

Route::get('logout', 'Auth\LoginController@logout');