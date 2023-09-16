<?php

namespace Database\Factories\Modules\V1\Employees\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\V1\Employees\Models\Employee;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid()->toString(),
            'employee_id' => 836931,
            'user_name' => 'farshidboroomand',
            'name_prefix' => 'F',
            'first_name' => 'Farshid',
            'middle_initial' => 'I',
            'last_name' => 'boroomand',
            'gender' => 'M',
            'email' => 'farshidboroomand@gmail.com',
            'date_of_birth' => '04/25/1988',
            'time_of_birth' => '12:38:12 AM',
            'age_in_yrs' => 35.01,
            'date_of_joining' => '10/07/2013',
            'age_in_company' => 1.01,
            'phone_number' => '203-799-7675',
            'place_name' => 'Karate',
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'zip' => 000000,
            'region' => 'West of Tehran',
        ];
    }
}
