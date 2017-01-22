<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|


Route::get('/', function () {
    return view('welcome');
});  */


Route::get('/', 'AdminController@login');

Route::get('/login', 'AdminController@login');

Route::get('/dashboard', 'DashboardController@index');

Route::get('/employees', 'EmployeeController@index');

Route::post('/employee-save', 'EmployeeController@store');

Route::post('/employee-del', 'EmployeeController@destroy');

Route::post('/employee-save/{id}', 'EmployeeController@update');

Route::post('/departments', 'DepartmentsController@data');

Route::post('/roles', 'RolesController@data');

Route::get('/data/{id?}', 'EmployeeController@data');

Route::get('/edit-emp/{id}', ['edit-emp' => 'EmployeeController@edit']);

Route::any('/create-emp', 'EmployeeController@create');

Route::any('/save', 'EmployeeController@save');

Route::any('/verifyuser', 'AdminController@auth');

Route::any('/logout', 'AdminController@logout');
