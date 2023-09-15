<?php

namespace Modules\V1\Files\Services\Uploaders\Minio;

use Modules\V1\Files\Services\Upload;

class UploadToMinio extends Upload
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
