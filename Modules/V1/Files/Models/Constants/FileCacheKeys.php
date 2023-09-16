<?php

namespace Modules\V1\Files\Models\Constants;

class FileCacheKeys
{
    public const CURRENT_FILE_EMPLOYEE_DUPLICATE_IDS_CACHE_KEY = 'current_file_employee_ids_';
    public const CURRENT_FILE_EMPLOYEE_DUPLICATE_IDS_TTL = 60 * 60 * 24; // 24 hours
}
