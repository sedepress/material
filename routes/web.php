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

Route::get('/login', 'IndexController@login');
Route::get('/', 'IndexController@index');
Route::get('/welcome', 'IndexController@welcome')->name('index.welcome');
Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/admin/create', 'AdminController@create')->name('admin.create');
Route::post('/admin', 'AdminController@store')->name('admin.store');
Route::get('/admin/{admin}/edit', 'AdminController@edit')->name('admin.edit');
Route::put('/admin/{admin}', 'AdminController@update')->name('admin.update');
Route::delete('/admin/{admin}', 'AdminController@destroy')->name('admin.destroy');
