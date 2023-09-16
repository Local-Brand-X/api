<?php

namespace Modules\V1\Files\Enums;

use App\Http\Enums\EnumValueListing;

enum FileMimeTypesEnum: string
{
    use EnumValueListing;
    case CSV = 'csv';
}
