<?php

namespace Modules\V1\Files\Enums;

use App\Http\Enums\EnumValueListing;

enum FileChunkSizeEnum: int
{
    use EnumValueListing;
    case DEFAULT = 1048576;
}
