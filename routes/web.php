<?php

use Illuminate\Support\Facades\Route;
use App\Micrositio;
use App\User;
use App\Venta;
use App\Categoria;
use App\Producto;

Auth::routes();

Route::get('/', function (){
    return view('welcome');
});

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
Route::get('/usuarios-show-{id}','UsuariosController@show')->name('usuarios.show');
Route::get('/usuarios-destroy-{id}','UsuariosController@destroy')->name('usuarios.destroy');
Route::get('/usuarios-restore-{id}','UsuariosController@restore')->name('usuarios.restore');
Route::get('/usuarios-edit-{id}','UsuariosController@edit')->name('usuarios.edit');
Route::get('/usuarios-update-{id}','UsuariosController@update')->name('usuarios.update');

//rutas para gestion de productos
Route::get('/productos-listar','ProductosController@index')->name('productos.listar');
Route::get('/productos-crear','ProductosController@create')->name('productos.crear');
Route::post('productos-store','ProductosController@store')->name('productos.store');
Route::get('/productos-show-{id}','ProductosController@show')->name('productos.show');
Route::get('/productos-destroy-{id}','ProductosController@destroy')->name('productos.destroy');
Route::get('/productos-restore-{id}','ProductosController@restore')->name('productos.restore');
Route::get('/productos-edit-{id}','ProductosController@edit')->name('productos.edit');
Route::get('/productos-update-{id}','ProductosController@update')->name('productos.update');

//rutas para gestion de servicios
Route::get('/servicios-listar','ServiciosController@index')->name('servicios.listar');
Route::get('/servicios-crear','ServiciosController@create')->name('servicios.crear');
Route::post('/servicios-store','ServiciosController@store')->name('servicios.store');
Route::get('/servicios-show-{id}','ServiciosController@show')->name('servicios.show');
Route::get('/servicios-destroy-{id}','ServiciosController@destroy')->name('servicios.destroy');
Route::get('/servicios-restore-{id}','ServiciosController@restore')->name('servicios.restore');
Route::get('/servicios-edit-{id}','ServiciosController@edit')->name('servicios.edit');
Route::get('/servicios-update-{id}','ServiciosController@update')->name('servicios.update');

//rutas para gestion de categorias
Route::get('/categorias-listar','CategoriasController@index')->name('categorias.listar');
Route::get('/categorias-crear','CategoriasController@create')->name('categorias.crear');
Route::post('/categorias-store','CategoriasController@store')->name('categorias.store');
Route::get('/categorias-show-{id}','CategoriasController@show')->name('categorias.show');
Route::get('/categorias-destroy-{id}','CategoriasController@destroy')->name('categorias.destroy');
Route::get('/categorias-restore-{id}','CategoriasController@restore')->name('categorias.restore');
Route::get('/categorias-edit-{id}','CategoriasController@edit')->name('categorias.edit');
Route::get('/categorias-update-{id}','CategoriasController@update')->name('categorias.update');


//rutas para micrositios
Route::get('/micrositios-listar','MicrositiosController@listar')->name('micrositios.listar');
Route::get('/micrositios-index','MicrositiosController@index')->name('micrositios.index');
Route::get('/micrositios-show-{id}','MicrositiosController@show')->name('micrositios.show');
Route::post('/micrositios-store','MicrositiosController@store')->name('micrositios.store');
Route::post('/micrositios-update-{id}','MicrositiosController@update')->name('micrositios.update');
Route::get('/micrositios-destroy-{id}','MicrositiosController@destroy')->name('micrositios.destroy');
Route::get('/micrositios-restore-{id}','MicrositiosController@restore')->name('micrositios.restore');
Route::get('/micrositios-edit-{id}','MicrositiosController@edit')->name('micrositios.edit');
//Route::get('/micrositios-mapa',function(){ return view('micrositios.mapa');})->name('micrsitios.mapa');


//rutas para ventas
Route::get('/ventas-listar','VentasController@index')->name('ventas.listar');
Route::get('/ventas-create-{id}','VentasController@create')->name('ventas.create');
Route::get('/ventas-store','VentasController@store')->name('ventas.store');
Route::get('/ventas-destroy-{id}','VentasController@destroy')->name('ventas.destroy');
Route::get('/ventas-restore-{id}','VentasController@restore')->name('ventas.restore');


//ruta para test de funciones
Route::get('/parse-json','TestController@json');
Route::get('/get/randomUser','TestController@ApiRandom');


//rutas de correo

Route::get('mail-enviado','MensajeController@store');


//peticiones ajax

Route::get('/get-municipios-{estado}','AjaxController@getMunicipios')->name('get.municipios');
Route::get('/get-micrositios/{categoria}','AjaxController@getMicrositios')->name('get.micrositios');
Route::get('/get-micrositios-palabra/{categoria}/{palabra}','AjaxController@getBySearch')->name('get.micrositios.palabra');
Route::get('/get-search/{palabra}','AjaxController@getSearch')->name('get.search');
Route::get('/get-data-donut','AjaxController@getDataDonut')->name('get.data.donut');
Route::get('/send/quotation/emal','MensajeController@sendQuotation')->name('send.quotation');

//Route::get('/mostrar-email',function(){ return view('correo.recuperar-contrasenia');});