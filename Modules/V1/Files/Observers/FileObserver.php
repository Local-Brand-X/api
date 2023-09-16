<?php

namespace Modules\V1\Files\Observers;

use Illuminate\Support\Facades\Cache;
use Modules\V1\Employees\Models\Constants\EmployeeCacheKeys;
use Modules\V1\Files\Models\File;

class FileObserver
{
    /**
     * Handle the File "created" event.
     *
     * @param File $file
     *
     * @return void
     */
    public function created(File $file): void
    {
        Cache::forget(EmployeeCacheKeys::EMPLOYEE_ID_CACHE_KEY);
    }
}
