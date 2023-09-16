<?php

namespace Modules\V1\Employees\Models\Pipelines;

use Illuminate\Pipeline\Pipeline;
use Modules\V1\Employees\Jobs\EmployeeImporterJob;
use Modules\V1\Employees\Models\Pipelines\Contracts\PipelineManagerInterface;
use Modules\V1\Employees\Models\Pipelines\Steps\DuplicateRemover\DuplicateRemover;
use Modules\V1\Employees\Models\Pipelines\Steps\Manipulator\Manipulator;
use Modules\V1\Files\Models\File;

class PipelineManager implements PipelineManagerInterface
{
    /**
     * @param array<string, mixed> $fileData
     * @param File                 $file
     *
     * There are two steps in order to clean up the csv file properly.
     * - Manipulator will change some format like Carbon and remove spaces
     * - Duplicator is responsible for removing duplicated entries based on employee_id
     *
     * @return void
     */
    public static function runPipeline(array $fileData, File $file): void
    {
        $fileData['original_file_id'] = $file->id;
        app(Pipeline::class)
            ->send($fileData)
            ->through([
                Manipulator::class,
                DuplicateRemover::class,
            ])->then(function (array $employees) {
                if (count($employees) > 0) {
                    EmployeeImporterJob::dispatch($employees);
                }
            });
    }
}
