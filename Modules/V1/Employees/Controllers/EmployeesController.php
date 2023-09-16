<?php

namespace Modules\V1\Employees\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\V1\Employees\Controllers\Actions\DeleteAnEmployeeAction;
use Modules\V1\Employees\Controllers\Actions\GetAllEmployeesAction;
use Modules\V1\Employees\Controllers\Actions\GetSingleEmployeeAction;
use Modules\V1\Employees\Controllers\Actions\UploadEmployeesAction;

class EmployeesController extends Controller
{
    /**
     * @param GetAllEmployeesAction $action
     *
     * @return JsonResponse
     */
    public function index(GetAllEmployeesAction $action): JsonResponse
    {
        return $this->handleAction($action);
    }

    /**
     * @param GetSingleEmployeeAction $action
     *
     * @return JsonResponse
     */
    public function show(GetSingleEmployeeAction $action): JsonResponse
    {
        return $this->handleAction($action);
    }

    /**
     * @param UploadEmployeesAction $action
     *
     * @return JsonResponse
     */
    public function store(UploadEmployeesAction $action): JsonResponse
    {
        return $this->handleAction($action);
    }

    /**
     * @param DeleteAnEmployeeAction $action
     *
     * @return JsonResponse
     */
    public function destroy(DeleteAnEmployeeAction $action): JsonResponse
    {
        return $this->handleAction($action);
    }
}
