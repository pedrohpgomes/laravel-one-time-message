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

// apresentar o formulario de criacao da mensagem
Route::get('/', 'Main@index')->name('main_index');
Route::post('/init','Main@init')->name('main_init');

//confirmacao do envio da mensagem
Route::get('/confirm/{purl?}','Main@confirm')->name('main_confirm');

//leitura da mensagem pelo receptor
Route::get('/read/{purl?}','Main@read')->name('main_read');