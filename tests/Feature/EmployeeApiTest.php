<?php

use App\Http\Responses\StatusCode;
use Modules\V1\Employees\Models\Employee;

beforeEach(function () {
    Employee::factory()->create();
});

it('can return all employees', function () {
    $response = $this->get(route('employees.index'));

    expect($response->getStatusCode())->toBe(StatusCode::OK->value);
    $response->assertJsonStructure([
        'data' => [
            [
                'id',
                'employee_id',
                'user_name',
                'name_prefix',
                'first_name',
                'middle_initial',
                'last_name',
                'gender',
                'email',
                'date_of_birth',
                'time_of_birth',
                'age_in_yrs',
                'date_of_joining',
                'age_in_company',
                'phone_number',
                'place_name',
                'country',
                'city',
                'zip',
                'region',
            ],
        ],
    ]);
});

it('can return a single employee', function () {
    $employeeId = Employee::query()->first()->employee_id;
    $response = $this->get(route('employees.show', ['employee' => $employeeId]));
    expect($response->getStatusCode())->toBe(StatusCode::OK->value);

    $response->assertJsonStructure([
        'data' => [
            'id',
            'employee_id',
            'user_name',
            'name_prefix',
            'first_name',
            'middle_initial',
            'last_name',
            'gender',
            'email',
            'date_of_birth',
            'time_of_birth',
            'age_in_yrs',
            'date_of_joining',
            'age_in_company',
            'phone_number',
            'place_name',
            'country',
            'city',
            'zip',
            'region',
        ],
    ]);
});

it('can delete an employee', function () {
    $employeeId = Employee::query()->first()->employee_id;
    $response = $this->delete(route('employees.destroy', ['employee' => $employeeId]));
    expect($response->getStatusCode())->toBe(StatusCode::OK->value);
    $response->assertSee(__('employees.employee_deleted'));
});
