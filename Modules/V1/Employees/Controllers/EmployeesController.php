<?php

namespace Modules\V1\Employees\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\V1\Employees\Controllers\Actions\UploadEmployeesAction;

class EmployeesController extends Controller
{
    /**
     * @param UploadEmployeesAction $action
     *
     * @return JsonResponse
     */
    public function store(UploadEmployeesAction $action): JsonResponse
    {
        return $this->handleAction($action);
    }
}
