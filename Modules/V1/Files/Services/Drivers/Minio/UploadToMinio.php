<?php

namespace Modules\V1\Files\Services\Drivers\Minio;

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
}
