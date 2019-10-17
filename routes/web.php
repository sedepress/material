<?php

Auth::routes(['register' => false]);

//主页面
Route::get('/', 'IndexController@index')->name('index');
Route::get('/welcome', 'IndexController@welcome')->name('index.welcome');

//管理员管理
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/create', 'AdminController@create')->name('admin.create');
    Route::post('/', 'AdminController@store')->name('admin.store');
    Route::get('/{admin}/edit', 'AdminController@edit')->name('admin.edit');
    Route::put('/{admin}', 'AdminController@update')->name('admin.update');
    Route::delete('/{admin}', 'AdminController@destroy')->name('admin.destroy');
    Route::get('/{admin}/change_password', 'AdminController@changePwdForm')->name('change_pwd_form');
    Route::patch('/{admin}/change_password', 'AdminController@changePwd')->name('change_pwd');
});

//部门管理
Route::prefix('dep')->group(function () {
    Route::get('/', 'DepartmentController@index')->name('dep.index');
    Route::post('/', 'DepartmentController@store')->name('dep.store');
    Route::get('/{department}/create', 'DepartmentController@create')->name('dep.create');
    Route::delete('/{department}', 'DepartmentController@destroy')->name('dep.destroy');
    Route::get('/{department}/edit', 'DepartmentController@edit')->name('dep.edit');
    Route::put('/{department}', 'DepartmentController@update')->name('dep.update');
});

//人员管理
Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/', 'UserController@store')->name('user.store');
    Route::get('/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::put('/{user}', 'UserController@update')->name('user.update');
    Route::delete('/{user}', 'UserController@destroy')->name('user.destroy');
    Route::patch('/{user}', 'UserController@exchangeStatus')->name('user.exchange_status');
});

//物品管理
Route::prefix('material')->group(function () {
    Route::get('/', 'MaterialController@index')->name('material.index');
    Route::get('/create', 'MaterialController@create')->name('material.create');
    Route::post('/', 'MaterialController@store')->name('material.store');
    Route::get('/{material}/edit', 'MaterialController@edit')->name('material.edit');
    Route::put('/{material}', 'MaterialController@update')->name('material.update');
    Route::delete('/{material}', 'MaterialController@destroy')->name('material.destroy');
    Route::patch('/{material}', 'MaterialController@exchangeStatus')->name('material.exchange_status');
    Route::get('/{material}/stock', 'MaterialController@adjust_form')->name('material.adjust_form');
    Route::patch('/{material}/stock', 'MaterialController@adjust')->name('material.adjust');
});

//物品领取管理
Route::prefix('materials_record')->group(function () {
    Route::get('/', 'MaterialsReceivingRecordController@index')->name('materials_record.index');
    Route::get('/create', 'MaterialsReceivingRecordController@create')->name('materials_record.create');
    Route::post('/', 'MaterialsReceivingRecordController@store')->name('materials_record.store');
    Route::get('/{materials_receiving_record}/edit', 'MaterialsReceivingRecordController@edit')->name('materials_record.edit');
    Route::put('/{materials_receiving_record}', 'MaterialsReceivingRecordController@update')->name('materials_record.update');
    Route::delete('/{materials_receiving_record}', 'MaterialsReceivingRecordController@destroy')->name('materials_record.destroy');
});
