<?php

use Modules\V1\Files\Controllers\Helpers\FileReader;

beforeEach(function () {
    $this->fileReader = new FileReader();
    $this->reflectionClass = new ReflectionClass(FileReader::class);
    $this->mapHeaderMethod = $this->reflectionClass->getMethod('mapHeader');
    $this->mapHeaderMethod->setAccessible(true);

    $this->givenData = [
        'Emp ID',
        'Name Prefix',
        'First Name',
        'Middle Initial',
        'Last Name',
        'Gender',
        'E Mail',
        'Date of Birth',
        'Time of Birth',
        'Age in Yrs.',
        'Date of Joining',
        'Age in Company (Years)',
        'Phone No. ',
        'Place Name',
        'County',
        'City',
        'Zip',
        'Region',
        'User Name',
    ];

    $this->expectedResult = [
        'employee_id',
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
        'user_name',
    ];
});

it('Headers Can Be Mapped', function () {
    $result = $this->mapHeaderMethod->invoke($this->fileReader, $this->givenData);
    expect($result)->toBeArray()->toMatchArray($this->expectedResult);
});

it('Headers Can Be Mapped Even With Shuffle', function () {
    shuffle($this->givenData);
    $result = $this->mapHeaderMethod->invoke($this->fileReader, $this->givenData);

    expect(array_keys($result))->toBe(array_keys($this->expectedResult));
});
