<?php

namespace Modules\V1\Employees\Models\Pipelines\Contracts;

use Modules\V1\Files\Models\File;

interface PipelineManagerInterface
{
    /**
     * @param array<string, mixed> $fileData
     * @param File                 $file
     *
     * @return void
     */
    public static function runPipeline(array $fileData, File $file): void;
}
