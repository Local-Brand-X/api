<?php

namespace Modules\V1\Files\Enums;

use App\Http\Enums\EnumValueListing;

enum FileNameLengthEnum: int
{
    use EnumValueListing;
    case DEFAULT = 20;
}
