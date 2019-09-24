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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/welcome', 'IndexController@welcome')->name('index.welcome');
Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/admin/create', 'AdminController@create')->name('admin.create');
Route::post('/admin', 'AdminController@store')->name('admin.store');
Route::get('/admin/{admin}/edit', 'AdminController@edit')->name('admin.edit');
Route::put('/admin/{admin}', 'AdminController@update')->name('admin.update');
Route::delete('/admin/{admin}', 'AdminController@destroy')->name('admin.destroy');
Route::get('/admin/{admin}/change_password', 'AdminController@changePwdForm')->name('change_pwd_form');
Route::patch('/admin/{admin}/change_password', 'AdminController@changePwd')->name('change_pwd');
Route::get('/dep', 'DepartmentController@index')->name('dep.index');
Route::post('/dep', 'DepartmentController@store')->name('dep.store');

Auth::routes(['register' => false]);
