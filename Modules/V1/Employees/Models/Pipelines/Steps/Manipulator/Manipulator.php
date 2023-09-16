<?php

namespace Modules\V1\Employees\Models\Pipelines\Steps\Manipulator;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Modules\V1\Employees\Enums\GenderEnum;
use Modules\V1\Employees\Models\Pipelines\Contracts\BasePipeline;

class Manipulator extends BasePipeline
{
    /**
     * @param array    $data
     * @param \Closure $next
     *
     * @return array
     */
    public function handle(array $data, \Closure $next): array
    {
        $result = [];
        $fileId = isset($data['original_file_id']) ? $data['original_file_id'] : null;

        unset($data['original_file_id']);
        foreach ($data as $employee) {
            if (isset($employee['employee_id'])) {
                $employee['employee_id'] = (int) $employee['employee_id'];
            }

            if (isset($employee['name_prefix'])) {
                $employee['name_prefix'] = trim($employee['name_prefix']);
            }

            if (isset($employee['first_name'])) {
                $employee['first_name'] = trim($employee['first_name']);
            }

            if (isset($employee['middle_initial'])) {
                $employee['middle_initial'] = trim($employee['middle_initial']);
            }

            if (isset($employee['last_name'])) {
                $employee['last_name'] = trim($employee['last_name']);
            }
            if (isset($employee['gender']) && null === GenderEnum::tryFrom($employee['gender'])) {
                continue;
            }

            if (isset($employee['email']) && !filter_var($employee['email'], FILTER_VALIDATE_EMAIL)) {
                continue;
            }

            if (isset($employee['date_of_birth'])) {
                $employee['date_of_birth'] = Carbon::createFromFormat('m/d/Y', $employee['date_of_birth'])->format('Y-m-d');
            }

            if (isset($employee['time_of_birth'])) {
                $employee['time_of_birth'] = Carbon::parse($employee['time_of_birth'])->format('h:i:s A');
            }

            if (isset($employee['age_in_yrs'])) {
                $employee['age_in_yrs'] = (float) $employee['age_in_yrs'];
            }

            if (isset($employee['date_of_joining'])) {
                $employee['date_of_joining'] = Carbon::createFromFormat('m/d/Y', $employee['date_of_joining'])->format('Y-m-d');
            }

            if (isset($employee['age_in_company'])) {
                $employee['age_in_company'] = (float) $employee['age_in_company'];
            }

            $phonePattern = '/^\d{3}-\d{3}-\d{4}$/';
            if (isset($employee['phone_number']) && !preg_match($phonePattern, $employee['phone_number'])) {
                continue;
            }

            if (isset($employee['place_name'])) {
                $employee['place_name'] = trim($employee['place_name']);
            }

            if (isset($employee['country'])) {
                $employee['country'] = trim($employee['country']);
            }

            if (isset($employee['city'])) {
                $employee['city'] = trim($employee['city']);
            }

            if (isset($employee['zip'])) {
                $employee['zip'] = (int) $employee['zip'];
            }

            if (isset($employee['region'])) {
                $employee['region'] = trim($employee['region']);
            }

            if (isset($employee['user_name'])) {
                $employee['user_name'] = trim($employee['user_name']);
            }

            $employee['id'] = Str::uuid()->toString();

            $result[] = $employee;
        }

        $result['original_file_id'] = $fileId;

        return $next($result);
    }
}
