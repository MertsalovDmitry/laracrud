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

Auth::routes();

Route::namespace('Dashboard')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::namespace('Employees')->group(function () {
        Route::get('employees/autocomplete', 'EmployeeAutoCompleteController@autocomplete')->name('employees.autocomplete');
        Route::post('employees/{id}', 'EmployeeController@update')->name('employees-update');
        Route::resource('employees', 'EmployeeController');
    });
    Route::namespace('Positions')->group(function () {
        Route::get('positions/list', 'PositionListController@list')->name('positions.list');
        Route::resource('positions', 'PositionController');
    });
});



