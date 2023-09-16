<?php

use Modules\V1\Employees\Models\Pipelines\Steps\Manipulator\Manipulator;

beforeEach(function () {
    $this->sampleData = [
        [
            'employee_id' => 36931,
            'name_prefix' => 'Ms. ',
            'first_name' => 'Selene ',
            'middle_initial' => 'S',
            'last_name' => 'Ford',
            'gender' => 'F',
            'email' => 'selene.ford@aol.com',
            'date_of_birth' => '04/25/1988',
            'time_of_birth' => '12:38:12 AM',
            'age_in_yrs' => 25.36,
            'date_of_joining' => '10/07/2013',
            'age_in_company' => 3.81,
            'phone_number' => '203-799-7675',
            'place_name' => 'Hartford ',
            'country' => 'Hartford',
            'city' => 'Hartford',
            'zip' => '6101',
            'region' => 'Northeast',
            'user_name' => 'ssford',
        ],
    ];

    $this->expectedResult = [
        'employee_id' => 36931,
        'name_prefix' => 'Ms.',
        'first_name' => 'Selene',
        'middle_initial' => 'S',
        'last_name' => 'Ford',
        'gender' => 'F',
        'email' => 'selene.ford@aol.com',
        'date_of_birth' => '1988-04-25',
        'time_of_birth' => '12:38:12 AM',
        'age_in_yrs' => 25.36,
        'date_of_joining' => '2013-10-07',
        'age_in_company' => 3.81,
        'phone_number' => '203-799-7675',
        'place_name' => 'Hartford',
        'country' => 'Hartford',
        'city' => 'Hartford',
        'zip' => 6101,
        'region' => 'Northeast',
        'user_name' => 'ssford',
    ];
});

it('data will be passed through manipulator step successfully', function () {
    $manipulator = new Manipulator();
    $result = $manipulator->handle($this->sampleData, function ($manipulatedData) {
        return $manipulatedData;
    });
    expect($result[0])->toBeArray()->toMatchArray($this->expectedResult);
});

it('data will be skipped if phone is not valid', function () {
    $this->sampleData[0]['phone_number'] = '1213/111/8888';
    $manipulator = new Manipulator();
    $result = $manipulator->handle($this->sampleData, function ($manipulatedData) {
        return $manipulatedData;
    });

    expect($result)->toBeArray()->toMatchArray([]);
});
