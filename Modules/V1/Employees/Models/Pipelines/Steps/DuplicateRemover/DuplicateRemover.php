<?php

namespace Modules\V1\Employees\Models\Pipelines\Steps\DuplicateRemover;

use Illuminate\Support\Facades\Cache;
use Modules\V1\Employees\Models\Constants\EmployeeCacheKeys;
use Modules\V1\Employees\Models\Employee;
use Modules\V1\Employees\Models\Pipelines\Contracts\BasePipeline;
use Modules\V1\Files\Models\Constants\FileCacheKeys;

class DuplicateRemover extends BasePipeline
{
    /**
     * @param array    $data
     * @param \Closure $next
     *
     * @return array
     */
    public function handle(array $data, \Closure $next): array
    {
        $fileId = isset($data['original_file_id']) ? $data['original_file_id'] : null;

        unset($data['original_file_id']);

        $data = $this->checkArrayUniqueness($data, 'employee_id');
        $data = $this->removeDuplicatedData($data, $fileId);

        return $next($data) ?? [];
    }

    /**
     * @param array  $data
     * @param string $key
     *
     * @return array
     */
    private function checkArrayUniqueness(array $data, string $key): array
    {
        $uniqueArray = [];
        foreach ($data as $item) {
            $employeeId = $item[$key];
            if (!isset($uniqueArray[$employeeId])) {
                $uniqueArray[$employeeId] = $item;
            }
        }

        return array_values($uniqueArray);
    }

    /**
     * @param array  $data
     * @param string $fileId
     *
     * @return array
     */
    private function removeDuplicatedData(array $data, string $fileId): array
    {
        $employeeIds = Cache::remember(
            EmployeeCacheKeys::EMPLOYEE_ID_CACHE_KEY,
            EmployeeCacheKeys::EMPLOYEE_ID_CACHE_TTL,
            static function () {
                return Employee::query()->pluck('employee_id')->all();
            }
        );

        $result = array_filter($data, static function ($employee) use ($employeeIds) {
            return !in_array($employee['employee_id'], $employeeIds, true);
        });

        $cacheKey = FileCacheKeys::CURRENT_FILE_EMPLOYEE_DUPLICATE_IDS_CACHE_KEY.$fileId;

        $newEmployeeIds = array_column($result, 'employee_id');
        $currentFileDuplicatedEmployeeIds = Cache::get($cacheKey);

        $blockedId = [];
        if ($currentFileDuplicatedEmployeeIds) {
            foreach ($currentFileDuplicatedEmployeeIds as $duplicatedId => $duplicatedValue) {
                if (in_array($duplicatedId, $newEmployeeIds, true) && $duplicatedValue > 0) {
                    $currentFileDuplicatedEmployeeIds[$duplicatedId] = 0;
                }

                if (0 === $duplicatedValue) {
                    $blockedId[] = $duplicatedId;
                }
            }
        }

        Cache::forget($cacheKey);
        Cache::remember(
            $cacheKey,
            FileCacheKeys::CURRENT_FILE_EMPLOYEE_DUPLICATE_IDS_TTL,
            static function () use ($currentFileDuplicatedEmployeeIds) {
                return $currentFileDuplicatedEmployeeIds;
            });

        return array_filter($result, static function ($employee) use ($blockedId) {
            return !in_array($employee['employee_id'], $blockedId, true);
        });
    }
}
