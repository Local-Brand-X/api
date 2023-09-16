<?php

namespace Modules\V1\Employees\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\V1\Employees\Models\Employee;

/**
 * @mixin Employee
 */
class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'user_name' => $this->user_name,
            'name_prefix' => $this->name_prefix,
            'first_name' => $this->first_name,
            'middle_initial' => $this->middle_initial,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'time_of_birth' => $this->time_of_birth,
            'age_in_yrs' => $this->age_in_yrs,
            'date_of_joining' => $this->date_of_joining,
            'age_in_company' => $this->age_in_company,
            'phone_number' => $this->phone_number,
            'place_name' => $this->place_name,
            'country' => $this->country,
            'city' => $this->city,
            'zip' => $this->zip,
            'region' => $this->region,
        ];
    }
}
