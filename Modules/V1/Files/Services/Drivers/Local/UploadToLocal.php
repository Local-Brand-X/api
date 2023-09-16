<?php

namespace Modules\V1\Files\Services\Drivers\Local;

use Illuminate\Support\Facades\Storage;
use Modules\V1\Files\Enums\FoldersEnum;
use Modules\V1\Files\Models\File;
use Modules\V1\Files\Services\Contracts\UploadInterface;

class UploadToLocal implements UploadInterface
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

    /**
     * @param File $file
     *
     * @return string
     */
    public function getFilePath(File $file): string
    {
        return Storage::disk('local')->path($file->path);
    }
}
