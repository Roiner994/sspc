<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('prueba/{id?}','ApiAuthController@prueba');
Route::post('login','ApiAuthController@authenticate');
Route::resource('notes','NoteController');
Route::resource('usuarios','UsuarioController');
Route::resource('carros','CarroController');

Route::get('carro_entrada/{id?}','Entrada_salida_carro_Controller@entrada_salida');
Route::get('usuario_entrada/{id?}','Entrada_salida_usuario_Controller@entrada_salida');
Route::get('fecha','Entrada_salida_usuario_Controller@fecha');
Route::get('fecha_carro','Entrada_salida_carro_Controller@fecha');
Route::get('usuario_dia','Entrada_salida_usuario_Controller@usuarioHoy');
Route::get('usuario_mes','Entrada_salida_usuario_Controller@usuarioMes');
Route::get('usuario_ano','Entrada_salida_usuario_Controller@usuarioAno');
Route::get('carro_dia','Entrada_salida_carro_Controller@carroHoy');
Route::get('carro_mes','Entrada_salida_carro_Controller@carroMes');
Route::get('carro_ano','Entrada_salida_carro_Controller@carroAno');
Route::get('usuarios_dentro','Entrada_salida_usuario_Controller@usuarios_dentro');
Route::get('carros_dentro','Entrada_salida_carro_Controller@carros_dentro');
Route::get('todos_los_usuarios','Entrada_salida_usuario_Controller@todos_los_usuarios');
Route::get('todos_los_carros','Entrada_salida_carro_Controller@todos_los_carros');
Route::post('filtrar_usuarios','Entrada_salida_usuario_Controller@filtrar_usuarios');
Route::post('filtrar_carros','Entrada_salida_carro_Controller@filtrar_carros');