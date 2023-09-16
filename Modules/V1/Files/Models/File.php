<?php

namespace Modules\V1\Files\Models;

use App\Http\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $filename
 * @property string $extension
 * @property string $mimetype
 * @property string $url
 * @property int    $size
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool   $should_delete
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
}
