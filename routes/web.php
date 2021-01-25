<?php

// Route::get('test', function(){
//     $user =new App\User;
//     $user->nombre = 'Fredi';
//     $user->apellido = 'Flores';
//     $user->sexo = 'Hombre';
//     $user->direccion = 'Barrio Municipal';
//     $user->telefono = '2222';
//     $user->email = 'fredi@email.com';
//     $user->user_name = 'fredi1';
//     $user->password = bcrypt('123123');
//     $user->save();

//     return $user;
// });

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

Route::get('saludos/{nombre?}', ['as' => 'saludos', 'uses' => 'PagesController@saludo']);

// Route::get('contactos', ['as' => 'contactos', 'uses' => 'PagesController@contacto']);


Route::resource('mensajes', 'MessagesController');

Route::resource('usuarios', 'UsersController');

Route::resource('pasajeros', 'PassangerController');

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@ShowLoginForm']);

Route::post('login', 'Auth\LoginController@Login');

Route::get('logout', 'Auth\LoginController@logout');