<?php

namespace Modules\V1\Files\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Modules\V1\Employees\Jobs\PipelineRunnerJob;
use Modules\V1\Files\Controllers\Helpers\FileReader;
use Modules\V1\Files\Events\FileUploaded;

class ImportUploadedFileData implements ShouldQueue
{
    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public ?string $queue = 'listeners';

    /**
     * Handle the event.
     */
    public function handle(FileUploaded $event): void
    {
        try {
            /** @var array<string, mixed> $chunkedEmployeesData */
            $chunkedEmployeesData = FileReader::convertCsvDataToArrayChunkByChunk($event->file);

            foreach ($chunkedEmployeesData as $employeesData) {
                PipelineRunnerJob::dispatch($employeesData, $event->file);
            }

            $event->file->should_delete = true;
            $event->file->save();
        } catch (\Exception $ex) {
            Log::info(
                'cannot run pipeline for fileId: '.$event->file->id.'due to : '.$ex->getMessage()
            );
        }
    }
}
