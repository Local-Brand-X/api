<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'employees',
    'namespace' => 'Employees\Controllers',
], static function () {
    Route::get('/', 'EmployeesController@index')->name('employees.index');
    Route::get('/{employee}', 'EmployeesController@show')->name('employees.show');
    Route::post('/', 'EmployeesController@store')->name('employees.store');
    Route::delete('/{employee}', 'EmployeesController@destroy')->name('employees.destroy');
});
