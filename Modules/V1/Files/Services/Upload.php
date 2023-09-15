<?php

namespace Modules\V1\Files\Services;

abstract class Upload
{
    /**
     * @param $file
     *
     * @return string
     */
    abstract public function doUpload($file): string;
}
