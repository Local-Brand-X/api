<?php

namespace Modules\V1\Files\Services\Contracts;

use Modules\V1\Files\Models\File;

interface UploadInterface
{
    /**
     * @param $file
     *
     * @return string
     */
    public function doUpload($file): string;

    /**
     * @param File $file
     *
     * @return string
     */
    public function getFilePath(File $file): string;
}
