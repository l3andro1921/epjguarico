<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WelcomeController@index')->name('inicio');

Auth::routes();

// ruta HOME
Route::get('/home', 'HomeController@index')->name('home');

// rutas Inicio
Route::get('/galeria', 'GaleriaController@index')->name('galeria');
Route::get('/fundador', 'GaleriaController@fundador')->name('fundador');
Route::get('/historia', 'GaleriaController@historia')->name('historia');
Route::get('/metas', 'GaleriaController@metas')->name('metas');


// rutas Contactos
Route::resource('contactos', 'ContactosController')->middleware('auth');

// rutas Usuarios
Route::resource('usuarios', 'UsersController')->middleware('auth');
Route::post('datos', 'UsersController@datos_store')->name('datos.store')->middleware('auth');
Route::put('datos/{id}', 'UsersController@datos_update')->name('datos.update')->middleware('auth');
Route::get('imagen/{id}/usuario', 'UsersController@imagen')->name('imagen.usuario')->middleware('auth');
Route::post('imagen/usuario', 'UsersController@imagen_update')->name('imagen.cambiar')->middleware('auth');

// rutas Miembros
Route::resource('miembros', 'MiembrosController')->middleware('auth');
Route::get('miembros_tipos', 'MiembrosController@create_tipos')->name('miembros_tipos.create')->middleware('auth');
Route::post('miembros_tipos', 'MiembrosController@store_tipos')->name('miembros_tipos.store')->middleware('auth');
Route::get('miembros_tipos/{id}/edit', 'MiembrosController@edit_tipos')->name('miembros_tipos.edit')->middleware('auth');
Route::put('miembros_tipos/{id}', 'MiembrosController@update_tipos')->name('miembros_tipos.update')->middleware('auth');
Route::delete('miembros_tipos/{id}', 'MiembrosController@destroy_tipos')->name('miembros_tipos.destroy')->middleware('auth');
Route::post('miembros/buscar', 'MiembrosController@create_cedula')->name('cedula.create')->middleware('auth');
Route::get('miembros/{id}/timeline', 'MiembrosController@timeline')->name('miembros.timeline')->middleware('auth');

// rutas Iglesias & Comunidades
Route::resource('iglesias', 'IglesiasController')->middleware('auth');
Route::get('comunidades', 'IglesiasController@create_comunidades')->name('comunidades.create')->middleware('auth');
Route::post('comunidades', 'IglesiasController@store_comunidades')->name('comunidades.store')->middleware('auth');
Route::get('comunidades/{id}/edit', 'IglesiasController@edit_comunidades')->name('comunidades.edit')->middleware('auth');
Route::put('comunidades/{id}', 'IglesiasController@update_comunidades')->name('comunidades.update')->middleware('auth');
Route::delete('comunidades/{id}', 'IglesiasController@destroy_comunidades')->name('comunidades.destroy')->middleware('auth');

// rutas Imagen
Route::get('imagen', 'HomeController@create')->name('imagen.create')->middleware('auth');
Route::post('imagen', 'HomeController@store')->name('imagen.store')->middleware('auth');
Route::get('imagen/{id}/edit', 'HomeController@edit')->name('imagen.edit')->middleware('auth');
Route::put('imagen/{id}', 'HomeController@update')->name('imagen.update')->middleware('auth');

// rutas perfil
Route::post('perfil', 'HomeController@datos_store')->name('perfil.store')->middleware('auth');
Route::put('perfil/{id}', 'HomeController@datos_update')->name('perfil.update')->middleware('auth');
Route::put('settings/{id}', 'HomeController@settings_update')->name('settings.update')->middleware('auth');
Route::put('seguridad/{id}', 'HomeController@seguridad_update')->name('seguridad.update')->middleware('auth');

// Rutas Noticias
Route::resource('noticias', 'NoticiasController');
Route::get('ver-noticias/{id}', 'WelcomeController@show')->name('welcome.show');

//Rutas Configuracion
Route::resource('configuracion', 'ConfiguracionController')->middleware('auth');
Route::delete('rango/{id}', 'ConfiguracionController@rango_destroy')->name('rango.destroy')->middleware('auth');
Route::post('rango', 'ConfiguracionController@rango_store')->name('rango.store')->middleware('auth');

// Rutas Eventos
Route::resource('eventos', 'EventosController')->middleware('auth');
Route::get('eventos/{id}/cerrado', 'EventosController@cerrado_show')->name('eventos.cerrado.show')->middleware('auth');
Route::post('eventos/{id}/cerrado', 'EventosController@cerrado_store')->name('eventos.cerrado.store')->middleware('auth');
Route::delete('eventos/{id}/cerrado', 'EventosController@cerrado_destroy')->name('eventos.cerrado.destroy')->middleware('auth');
Route::get('eventos/{id}/asistencia', 'EventosController@asistencia_show')->name('eventos.asistencia.show')->middleware('auth');
Route::put('eventos/{id}/asistencia', 'EventosController@asistencia_update')->name('eventos.asistencia.update')->middleware('auth');
Route::post('eventos/{id}/participante', 'EventosController@participante_store')->name('eventos.participante.store')->middleware('auth');
Route::delete('eventos/{id}/participante', 'EventosController@participante_destroy')->name('eventos.participante.destroy')->middleware('auth');

//Rutas Agenda
Route::resource('agenda', 'AgendaController')->middleware('auth');
Route::get('agenda/{id}/create', 'AgendaController@agenda_create')->name('agenda.create.show')->middleware('auth');


// Rutas Eventos Miembros
Route::resource('mieventos', 'EventosMiembrosController')->middleware('auth');

// Rutas Galeria 
Route::get('/galeria/inicio', 'GaleriaController@home')->name('galeria.home');
Route::post('/galeria/agregar', 'GaleriaController@agregar')->name('galeria.create');
Route::get('/galeria/cargar', 'GaleriaController@carga')->name('galeria.carga');