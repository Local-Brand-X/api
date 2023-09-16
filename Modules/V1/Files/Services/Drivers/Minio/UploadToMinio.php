<?php

namespace Modules\V1\Files\Services\Drivers\Minio;

use Modules\V1\Files\Models\File;
use Modules\V1\Files\Services\Contracts\UploadInterface;

class UploadToMinio implements UploadInterface
{
    /**
     * @param $file
     *
     * @return string
     */
    public function doUpload($file): string
    {
        // TODO: add minio storage
        return '';
    }

    /**
     * @param File $file
     *
     * @return string
     */
    public function getFilePath(File $file): string
    {
        // TODO: Implement getFile() method.
        return '';
    }
}
