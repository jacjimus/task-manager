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
// All routes related to Employees
Route::any('/employees', 'EmployeeController@index');

Route::get('/employee/{id?}', 'EmployeeController@data');

Route::post('/employee', 'EmployeeController@store');

Route::delete('/employee/{id}', 'EmployeeController@destroy');

Route::post('/employee/{id}', 'EmployeeController@update');

Route::post('/departments', 'DepartmentsController@data');

Route::post('/roles', 'RolesController@data');

Route::get('/edit-emp/{id}', ['edit-emp' => 'EmployeeController@edit']);

Route::any('/create-emp', 'EmployeeController@create');

Route::any('/save', 'EmployeeController@save');
// All routes related to task categories

Route::any('/task-categories', 'TaskCategoriesController@index');

Route::get('/category/{id?}', 'TaskCategoriesController@data');

Route::post('/category', 'TaskCategoriesController@store');

Route::post('/category/{id}', 'TaskCategoriesController@update');

Route::delete('/category/{id}', 'TaskCategoriesController@destroy');

Route::any('/verifyuser', 'AdminController@auth');

Route::any('/logout', 'AdminController@logout');
