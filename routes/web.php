<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('niveis', 'RoleController');
Route::resource('permissoes', 'PermissionController');
Route::resource('areas', 'AreaController');
Route::resource('proles', 'PermissionRoleController');
Route::resource('rusers', 'RegraController');
Route::resource('users', 'UserController');
Route::resource('fluxos', 'FluxoController');
Route::resource('equipes', 'EquipeController');
Route::resource('equipesmembros', 'MembrosEquipeController');
Route::get('euipesmembros/{id}', 'EquipeController@Adicionar')
        ->name('equipes.adicionar');
Route::post('carrosfotostore', 'CarroController@storefoto')
        ->name('carros.storefoto');
Route::post('equipedetalhes', 'EquipeController@detalhes')
        ->name('equipes.detalhes');



