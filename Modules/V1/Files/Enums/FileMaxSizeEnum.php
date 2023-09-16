<?php

namespace Modules\V1\Files\Enums;

use App\Http\Enums\EnumValueListing;

enum FileMaxSizeEnum: int
{
    use EnumValueListing;
    case DEFAULT = 20000; // 20Mb
}
