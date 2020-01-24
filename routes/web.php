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

Route::get('/painel', 'painel\ProdutoController@index')->name('painel');
Route::get('/painel/create', 'painel\ProdutoController@create');
Route::post('/painel/create/store', 'painel\ProdutoController@store');
Route::get('/painel/{id}/edit', 'painel\ProdutoController@edit');
Route::put('/painel/{id}/update', 'painel\ProdutoController@updateProduto');
Route::get('/', 'painel\ProdutoController@index');