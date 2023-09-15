<?php

namespace Modules\V1\Files\Services\Contracts;

interface UploadInterface
{
    /**
     * @param $file
     *
     * @return string
     */
    public function doUpload($file): string;
}
