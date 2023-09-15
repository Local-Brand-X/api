<?php

namespace Modules\V1\Files\Models;

use Carbon\Carbon;
use App\Http\Traits\Uuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string       $id
 * @property string       $filename
 * @property string       $extension
 * @property string       $mimetype
 * @property string       $url
 * @property int          $size
 * @property Carbon       $created_at
 * @property Carbon       $updated_at
 * @property bool       $should_delete
 */
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

    /**
     * @return void
     */
    public function shouldDelete(): void
    {
        $this->should_delete = true;
        $this->save();
    }
}
