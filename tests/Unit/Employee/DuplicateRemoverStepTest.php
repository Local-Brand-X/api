<?php

use Modules\V1\Employees\Models\Employee;
use Modules\V1\Employees\Models\Pipelines\Steps\DuplicateRemover\DuplicateRemover;

beforeEach(function () {
    Employee::factory()->create();
    $this->sampleData = [
        [
            'employee_id' => 836931,
            'name_prefix' => 'Ms.',
            'first_name' => 'Selene',
            'middle_initial' => 'S',
            'last_name' => 'Ford',
            'gender' => 'F',
            'email' => 'selene.ford@aol.com',
            'date_of_birth' => '03/23/1992',
            'time_of_birth' => '12:38:12 AM',
            'age_in_yrs' => 25.36,
            'date_of_joining' => '10/07/2013',
            'age_in_company' => 3.81,
            'phone_number' => '203-799-7675',
            'place_name' => 'Hartford',
            'country' => 'Hartford',
            'city' => 'Hartford',
            'zip' => 6101,
            'region' => 'Northeast',
            'user_name' => 'ssford',
        ],
        [
            'employee_id' => 836932,
            'name_prefix' => 'Ms.',
            'first_name' => 'Farshid',
            'middle_initial' => 'S',
            'last_name' => 'Boroomand',
            'gender' => 'F',
            'email' => 'farshidboroomand@gmail.com',
            'date_of_birth' => '25/25/1988',
            'time_of_birth' => '12:38:12 AM',
            'age_in_yrs' => 25.36,
            'date_of_joining' => '10/07/2013',
            'age_in_company' => 3.81,
            'phone_number' => '203-799-7675',
            'place_name' => 'Hartford',
            'country' => 'Iran',
            'city' => 'Tehran',
            'zip' => 0000,
            'region' => 'Northeast',
            'user_name' => 'kyokushin_farshid',
        ],
        'original_file_id' => fake()->uuid,
    ];

    $this->expectedResult = [
        'employee_id' => 836932,
        'name_prefix' => 'Ms.',
        'first_name' => 'Farshid',
        'middle_initial' => 'S',
        'last_name' => 'Boroomand',
        'gender' => 'F',
        'email' => 'farshidboroomand@gmail.com',
        'date_of_birth' => '25/25/1988',
        'time_of_birth' => '12:38:12 AM',
        'age_in_yrs' => 25.36,
        'date_of_joining' => '10/07/2013',
        'age_in_company' => 3.81,
        'phone_number' => '203-799-7675',
        'place_name' => 'Hartford',
        'country' => 'Iran',
        'city' => 'Tehran',
        'zip' => 0000,
        'region' => 'Northeast',
        'user_name' => 'kyokushin_farshid',
    ];
});

it('duplicate employees will be excluded', function () {
    $manipulator = new DuplicateRemover();

    $result = $manipulator->handle($this->sampleData, function ($manipulatedData) {
        return $manipulatedData;
    });

    $result = array_values($result);
    expect($result[0])->toBeArray()->toMatchArray($this->expectedResult);
});
