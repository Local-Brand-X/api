<?php

namespace Modules\V1\Employees\Controllers\Actions;

use App\Http\Actions\Action;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Modules\V1\Employees\Models\Constants\EmployeeCacheKeys;
use Modules\V1\Employees\Models\Employee;
use Modules\V1\Employees\Resources\Api\EmployeeResource;

class GetAllEmployeesAction extends Action
{
    /**
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        /** @var string $orderBy */
        $orderBy = $this->request->query('order_by', 'created_at');
        /** @var string $sortBy */
        $sortBy = $this->request->query('sort_by', 'desc');

        $employees = Cache::remember(
            $this->getCacheKey($orderBy, $sortBy),
            EmployeeCacheKeys::EMPLOYEE_ID_CACHE_TTL,
            static function () use ($orderBy, $sortBy) {
                return Employee::query()
                               ->orderBy($orderBy, $sortBy)
                               ->get();
            }
        );

        return $this->resourceCollectionResponse(EmployeeResource::collection($employees));
    }

    /**
     * @param string $orderBy
     * @param string $sortBy
     *
     * @return string
     */
    private function getCacheKey(string $orderBy, string $sortBy): string
    {
        return sprintf(EmployeeCacheKeys::EMPLOYEE_LIST.'_%s__%s_', $orderBy, $sortBy);
    }
}
