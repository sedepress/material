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

Route::get('/', 'IndexController@index');
Route::get('/welcome', 'IndexController@welcome')->name('index.welcome');
Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/admin/create', 'AdminController@create')->name('admin.create');
Route::post('/admin', 'AdminController@store')->name('admin.store');
