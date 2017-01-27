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
// All routes related to tasks

Route::any('/dashboard', 'TasksController@index');

Route::any('/ongoing-tasks', 'TasksController@ongoing');

Route::get('/task/{id?}', 'TasksController@data');

Route::get('/comments/{id?}', 'TasksController@comments');

Route::get('/view-task/{id?}/{notif?}', 'TasksController@task');

Route::get('/tasksdata/{id?}', 'TasksController@tasksdata');

Route::post('/task', 'TasksController@store');

Route::post('/task/{id}', 'TasksController@update');

Route::delete('/task/{id}', 'TasksController@destroy');

Route::post('/follow/{id}', 'TasksController@follow');

Route::post('/check-follows/{id}', 'TasksController@check_if_user_follow');

Route::post('/close/{id}', 'TasksController@close');

Route::post('/my_department', 'TasksController@my_dept');

Route::get('/empdept', 'EmployeeController@empdept');

Route::any('/verifyuser', 'AdminController@auth');

Route::any('/logout', 'AdminController@logout');

Route::post('/send', 'EmailController@send');
 // Reports routes

Route::get('/daily-reports', 'ReportsController@daily');

Route::get('/weekly-reports', 'ReportsController@weekly');