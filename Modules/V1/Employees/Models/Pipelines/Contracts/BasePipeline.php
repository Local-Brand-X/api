<?php

namespace Modules\V1\Employees\Models\Pipelines\Contracts;

abstract class BasePipeline
{
    /**
     * @param array    $data
     * @param \Closure $next
     *
     * @return array
     */
    abstract public function handle(array $data, \Closure $next): array;
}
