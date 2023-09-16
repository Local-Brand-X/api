<?php

namespace Modules\V1\Employees\Models;

use App\Http\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $employee_id
 * @property string $user_name
 * @property string $name_prefix
 * @property string $first_name
 * @property string $middle_initial
 * @property string $last_name
 * @property string $gender
 * @property string $email
 * @property Carbon $date_of_birth
 * @property Carbon $time_of_birth
 * @property float  $age_in_yrs
 * @property Carbon $date_of_joining
 * @property float  $age_in_company
 * @property string $phone_number
 * @property string $place_name
 * @property string $country
 * @property string $city
 * @property string $zip
 * @property string $region
 */
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

    /**
     * @param int $employeeId
     *
     * @return Builder<Employee>
     */
    public function scopeFindByEmployeeId(Builder $query, int $employeeId): Builder
    {
        return $query->where('employee_id', $employeeId);
    }
}
