<?php

namespace Modules\V1\Files\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\V1\Files\Models\File;

/**
 * @mixin File
 */
class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'filename' => $this->filename,
        ];
    }
}
