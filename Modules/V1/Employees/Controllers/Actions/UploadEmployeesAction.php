<?php

namespace Modules\V1\Employees\Controllers\Actions;

use App\Http\Actions\Action;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\V1\Files\Controllers\Actions\UploadFile;
use Modules\V1\Files\Enums\FileMaxSizeEnum;
use Modules\V1\Files\Enums\FileMimeTypesEnum;

class UploadEmployeesAction extends Action
{
    protected UploadFile $uploader;

    public function __construct(Request $request, UploadFile $uploader)
    {
        parent::__construct($request);
        $this->uploader = $uploader;
    }

    /**
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        return $this->uploader->execute();
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:'.FileMimeTypesEnum::CSV->value,
                'max:'.FileMaxSizeEnum::DEFAULT->value,
            ],
        ];
    }
}
