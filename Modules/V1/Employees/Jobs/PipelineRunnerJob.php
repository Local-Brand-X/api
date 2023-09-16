<?php

namespace Modules\V1\Employees\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\V1\Employees\Models\Pipelines\PipelineManager;
use Modules\V1\Files\Models\File;

class PipelineRunnerJob implements ShouldQueue
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
    public function __construct(public array $employees, public File $file)
    {
        $this->queue = 'pipeline_queue';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            PipelineManager::runPipeline($this->employees, $this->file);
        } catch (\Exception $ex) {
            Log::info(
                'cannot send file to importer pipeline due to: '.$ex->getMessage()
            );
            $this->failed();
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
