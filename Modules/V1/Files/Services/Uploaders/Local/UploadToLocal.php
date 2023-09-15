<?php

namespace Modules\V1\Files\Services\Uploaders\Local;

use Illuminate\Support\Facades\Storage;
use Modules\V1\Files\Enums\FoldersEnum;
use Modules\V1\Files\Services\Upload;

class UploadToLocal extends Upload
{
    /**
     * @param $file
     *
     * @return string
     */
    public function doUpload($file): string
    {
        return Storage::disk('local')
                      ->put(FoldersEnum::EMPLOYEES->value, $file);
    }
}
