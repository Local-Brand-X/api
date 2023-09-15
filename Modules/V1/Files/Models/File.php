<?php

namespace Modules\V1\Files\Models;

use App\Http\Traits\Uuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use Uuids;
    protected $fillable = [
        'filename',
        'extension',
        'mimetype',
        'path',
        'size',
    ];

    /**
     * @param Builder $query
     *
     * @return Builder<File>
     */
    public function scopeReadyToDelete(Builder $query): Builder
    {
        return $query->where('should_delete', true);
    }

    /*
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return Storage::disk(config('filesystems.default'))->url($this->path);
    }

    /**
     * @return void
     */
    public function shouldDelete(): void
    {
        $this->should_delete = true;
        $this->save();
    }
}
