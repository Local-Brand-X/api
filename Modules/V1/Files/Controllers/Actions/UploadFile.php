<?php

namespace Modules\V1\Files\Controllers\Actions;

use App\Http\Actions\Action;
use App\Http\Responses\StatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\V1\Files\Resources\FileResource;
use Modules\V1\Files\Controllers\Helpers\FileInfoGetter;
use Modules\V1\Files\Exceptions\FileUploadException;
use Modules\V1\Files\Models\File;
use Modules\V1\Files\Services\Contracts\UploadInterface;

class UploadFile extends Action
{
    protected UploadInterface $uploaderService;

    public function __construct(Request $request, UploadInterface $uploaderService)
    {
        parent::__construct($request);
        $this->uploaderService = $uploaderService;
    }

    /**
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        try {
            $file = $this->request->file('file');
            $fileInfo = FileInfoGetter::extractFileInfos($file);
            $filePath = $this->uploaderService->doUpload($file);

            $file = File::create([
                'filename' => $fileInfo['filename'],
                'extension' => $fileInfo['extension'],
                'mimetype' => $fileInfo['mimeType'],
                'path' => $filePath,
                'size' => $fileInfo['size'],
            ]);

            return $this->dataResponse([
                'message' => __('files.file_uploaded'),
                'data' => new FileResource($file),
            ]);
        } catch (FileUploadException $ex) {
            Log::error('Cannot upload file :'.$ex->getMessage());

            return $this->clientErrorResponse(
                __('files.file_upload_failed'),
                StatusCode::INTERNAL_SERVER_ERROR
            );
        }
    }
}
