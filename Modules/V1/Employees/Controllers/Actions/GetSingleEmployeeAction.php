<?php

namespace Modules\V1\Employees\Controllers\Actions;

use App\Http\Actions\Action;
use Illuminate\Http\JsonResponse;
use Modules\V1\Employees\Models\Employee;
use Modules\V1\Employees\Resources\Api\EmployeeResource;

class GetSingleEmployeeAction extends Action
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

        return $this->resourceResponse(new EmployeeResource($employee));
    }
}
