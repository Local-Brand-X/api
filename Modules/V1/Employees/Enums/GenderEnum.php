<?php

namespace Modules\V1\Employees\Enums;

use App\Http\Enums\EnumValueListing;

enum GenderEnum: string
{
    use EnumValueListing;
    case FEMALE = 'F';
    case MALE = 'M';
}
