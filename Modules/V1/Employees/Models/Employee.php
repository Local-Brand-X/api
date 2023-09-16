<?php

namespace Modules\V1\Employees\Models;

use App\Http\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use Uuids;
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'user_name',
        'name_prefix',
        'first_name',
        'middle_initial',
        'last_name',
        'gender',
        'email',
        'date_of_birth',
        'time_of_birth',
        'age_in_yrs',
        'date_of_joining',
        'age_in_company',
        'phone_number',
        'place_name',
        'country',
        'city',
        'zip',
        'region',
    ];
}
