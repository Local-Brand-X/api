<?php

namespace Modules\V1\Files\Enums;

use App\Http\Enums\EnumValueListing;

enum FoldersEnum: string
{
    use EnumValueListing;
    case EMPLOYEES = 'employees';
}
