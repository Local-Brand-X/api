<?php

namespace Modules\V1\Employees\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\V1\Employees\Models\Employee;

class EmployeeImporterJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 5;
    public int $retryAfter = 10;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $employees)
    {
        $this->queue = 'import_queue';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        try {
            Employee::insert($this->employees);
            DB::commit();
        } catch (\Exception $ex) {
            Log::error('Cannot insert employees :'.$ex->getMessage());
            DB::rollBack();
        }
    }

    /**
     * Handle a job failure after specific seconds.
     *
     * @return void
     */
    public function failed(): void
    {
        $this->release($this->retryAfter);
    }
}
