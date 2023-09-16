<?php

namespace Modules\V1\Employees\Controllers\Actions;

use App\Http\Actions\Action;
use Illuminate\Http\JsonResponse;
use Modules\V1\Employees\Models\Employee;

class DeleteAnEmployeeAction extends Action
{
    /**
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $employeeId = (int) $this->request->route('employee');

        /** @var Employee $employee */
        $employee = Employee::query()->findByEmployeeId($employeeId)->first();

        /*** @phpstan-ignore-next-line */
        if (null === $employee) {
            return $this->messageResponse(__('employees.employee_not_found'));
        }

        $employee->delete();

        return $this->messageResponse(__('employees.employee_deleted'));
    }
}
