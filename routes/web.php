<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//rutas para gestion de autentificación
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('register', '\App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('password-reset', '\App\Http\Controllers\Auth\ForgotPasswordController@index')->name('password.reset');
Route::get('password-send', '\App\Http\Controllers\Auth\ForgotPasswordController@resetPassword')->name('password.send');

//rutas para gestion de usuarios
Route::get('/usuarios-listar','UsuariosController@index')->name('usuarios.listar');
Route::get('/usuarios-crear','UsuariosController@create')->name('usuarios.crear');
Route::post('/usuarios-store','UsuariosController@store')->name('usuarios.store');
Route::get('/usuarios/show/{id}','UsuariosController@show')->name('usuarios.show');
Route::get('/usuarios/destroy/{id}','UsuariosController@destroy')->name('usuarios.destroy');
Route::get('/usuarios/restore/{id}','UsuariosController@restore')->name('usuarios.restore');
Route::get('/usuarios/edit/{id}','UsuariosController@edit')->name('usuarios.edit');
Route::get('/usuarios/update/{id}','UsuariosController@update')->name('usuarios.update');

//rutas para gestion de productos
Route::get('/productos-listar','ProductosController@index')->name('productos.listar');
Route::get('/productos-crear','ProductosController@create')->name('productos.crear');
Route::post('productos-store','ProductosController@store')->name('productos.store');
Route::get('/productos/show/{id}','ProductosController@show')->name('productos.show');
Route::get('/productos/destroy/{id}','ProductosController@destroy')->name('productos.destroy');
Route::get('/productos/restore/{id}','ProductosController@restore')->name('productos.restore');
Route::get('/productos/edit/{id}','ProductosController@edit')->name('productos.edit');
Route::get('/productos/update/{id}','ProductosController@update')->name('productos.update');

//rutas para gestion de servicios
Route::get('/servicios-listar','ServiciosController@index')->name('servicios.listar');
Route::get('/servicios-crear','ServiciosController@create')->name('servicios.crear');
Route::post('servicios-store','ServiciosController@store')->name('servicios.store');
Route::get('/servicios/show/{id}','ServiciosController@show')->name('servicios.show');
Route::get('/servicios/destroy/{id}','ServiciosController@destroy')->name('servicios.destroy');
Route::get('/servicios/restore/{id}','ServiciosController@restore')->name('servicios.restore');
Route::get('/servicios/edit/{id}','ServiciosController@edit')->name('servicios.edit');
Route::get('/servicios/update/{id}','ServiciosController@update')->name('servicios.update');

//rutas para micrositios
Route::get('/micrositios-listar','MicrositiosController@listar')->name('micrositios.listar');
Route::get('/micrositios-index','MicrositiosController@index')->name('micrositios.index');
Route::get('/micrositios-show/{id}','MicrositiosController@show')->name('micrositios.show');
Route::post('/micrositios-store','MicrositiosController@store')->name('micrositios.store');
Route::post('/micrositios/update/{id}','MicrositiosController@update')->name('micrositios.update');
Route::get('/micrositios/destroy/{id}','MicrositiosController@destroy')->name('micrositios.destroy');
Route::get('/micrositios/restore/{id}','MicrositiosController@restore')->name('micrositios.restore');
Route::get('/micrositios/edit/{id}','MicrositiosController@edit')->name('micrositios.edit');
Route::get('/micrositios-mapa',function(){ return view('micrositios.mapa');})->name('micrsitios.mapa');

//ruta para test de funciones

Route::get('/parse-json','TestController@json');


//rutas de correo

Route::get('mail-enviado','MensajeController@store');


//peticiones ajax

Route::get('/get-municipios/{estado}','AjaxController@getMunicipios')->name('get.municipios');
Route::get('/get-micrositios/{categoria}','AjaxController@getMicrositios')->name('get.micrositios');
Route::get('/get-micrositios-palabra/{categoria}/{palabra}','AjaxController@getBySearch')->name('get.micrositios.palabra');
Route::get('/get-data-donut','AjaxController@getDataDonut')->name('get.data.donut');