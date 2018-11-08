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
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('niveis', 'RoleController');
Route::resource('notificacoes', 'NotificacaoController');
Route::resource('etapas', 'EtapaController');
Route::resource('permissoes', 'PermissionController');
Route::resource('areas', 'AreaController');
Route::resource('proles', 'PermissionRoleController');
Route::resource('rusers', 'RegraController');
Route::resource('users', 'UserController');
Route::resource('fluxos', 'FluxoController');
Route::resource('equipes', 'EquipeController');
Route::resource('equipesmembros', 'MembrosEquipeController');
Route::get('equipemembro/{id}', 'EquipeController@Adicionar')
    ->name('equipes.adicionar');
Route::get('equipedetalhes/{id}', 'EquipeController@detalhes')
    ->name('equipes.detalhes');
Route::get('fluxodetalhes/{id}', 'FluxoController@detalhes')
    ->name('fluxos.detalhes');
Route::get('fluxoadicionar/{id}', 'FluxoController@adicionar')
    ->name('fluxos.adicionar');
Route::get('fluxofinalizar/{id}', 'FluxoController@finalizar')
    ->name('fluxos.finalizar');
Route::post('fluxoadicionarsalvar/{id}', 'FluxoController@adicionarSalvar')
    ->name('fluxoatividade.adicionarSalvar');
Route::get('finalizar/{id}', 'NotificacaoController@finalizar')
    ->name('notificacao.finalizar');
Route::get('adicionarmembro/{id}', 'MembrosEquipeController@adicionar')
    ->name('equipemembros.adicionar');
Route::get('equiperesponsavel/{id}', 'EquipeController@responsavel')
    ->name('equipe.responsavel');

 
