<?php

namespace Modules\V1\Employees\Models\Contants;

class EmployeeCacheKeys
{
    public const EMPLOYEE_ID_CACHE_KEY = 'employee_id_list';
    public const EMPLOYEE_ID_CACHE_TTL = 60 * 60 * 24; // 24 hours
}
