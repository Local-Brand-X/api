<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'employee',
    'namespace' => 'Employees\Controllers',
], static function () {
    Route::post('/', 'EmployeesController@store')->name('employees.store');
});
