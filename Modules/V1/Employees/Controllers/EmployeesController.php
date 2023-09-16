<?php

namespace Modules\V1\Employees\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\V1\Employees\Controllers\Actions\DeleteAnEmployeeAction;
use Modules\V1\Employees\Controllers\Actions\GetAllEmployeesAction;
use Modules\V1\Employees\Controllers\Actions\GetSingleEmployeeAction;
use Modules\V1\Employees\Controllers\Actions\UploadEmployeesAction;

class EmployeesController extends Controller
{
    /**
     * @param GetAllEmployeesAction $action
     *
     * @return JsonResponse
     *
     * @OA\Get(
     *     path="/api/v1/employee",
     *     summary="Get a list of employees",
     *     tags={"Employees"},
     *     @OA\Parameter(
     *         name="paginated",
     *         in="query",
     *         description="Pagination indicator (1 for paginated results, 0 for all results)",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             enum={0, 1},
     *             default=1
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page (applicable when 'paginated' is 1)",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=15
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of employees retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="string", example="0001a9bd-9064-4ad9-9e7b-651e253d1e19"),
     *                     @OA\Property(property="employee_id", type="integer", example=940994),
     *                     @OA\Property(property="user_name", type="string", example="rogravely"),
     *                     @OA\Property(property="name_prefix", type="string", example="Dr."),
     *                     @OA\Property(property="first_name", type="string", example="Rodger"),
     *                     @OA\Property(property="middle_initial", type="string", example="O"),
     *                     @OA\Property(property="last_name", type="string", example="Gravely"),
     *                     @OA\Property(property="gender", type="string", example="M"),
     *                     @OA\Property(property="email", type="string", example="rodger.gravely@hotmail.com"),
     *                     @OA\Property(property="date_of_birth", type="string", format="date", example="1993-09-17"),
     *                     @OA\Property(property="time_of_birth", type="string", format="time", example="04:26:26 AM"),
     *                     @OA\Property(property="age_in_yrs", type="number", format="float", example=23.88),
     *                     @OA\Property(property="date_of_joining", type="string", format="date", example="2014-11-05"),
     *                     @OA\Property(property="age_in_company", type="number", format="float", example=2.73),
     *                     @OA\Property(property="phone_number", type="string", example="231-704-4289"),
     *                     @OA\Property(property="place_name", type="string", example="Dimondale"),
     *                     @OA\Property(property="country", type="string", example="Eaton"),
     *                     @OA\Property(property="city", type="string", example="Dimondale"),
     *                     @OA\Property(property="zip", type="integer", example=48821),
     *                     @OA\Property(property="region", type="string", example="Midwest"),
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No employees found"
     *     )
     * )
     */
    public function index(GetAllEmployeesAction $action): JsonResponse
    {
        return $this->handleAction($action);
    }

    /**
     * @param GetSingleEmployeeAction $action
     *
     * @return JsonResponse
     * @OA\Get(
     *     path="/api/v1/employee/{employee_id}",
     *     summary="Get a single employee by ID",
     *     tags={"Employees"},
     *     @OA\Parameter(
     *         name="employee_id",
     *         in="path",
     *         description="ID of the employee to retrieve",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Employee details retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 type="string",
     *                 example="68fbdc1f-db93-4e6a-9e2d-a56b2be6d766"
     *             ),
     *             @OA\Property(
     *                 property="employee_id",
     *                 type="integer",
     *                 example=12345
     *             ),
     *             @OA\Property(
     *                 property="user_name",
     *                 type="string",
     *                 example="rogravely"
     *             ),
     *             @OA\Property(
     *                 property="name_prefix",
     *                 type="string",
     *                 example="Dr."
     *             ),
     *             @OA\Property(
     *                 property="first_name",
     *                 type="string",
     *                 example="Rodger"
     *             ),
     *             @OA\Property(
     *                 property="middle_initial",
     *                 type="string",
     *                 example="O"
     *             ),
     *             @OA\Property(
     *                 property="last_name",
     *                 type="string",
     *                 example="Gravely"
     *             ),
     *             @OA\Property(
     *                 property="gender",
     *                 type="string",
     *                 example="M"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 example="rodger.gravely@hotmail.com"
     *             ),
     *             @OA\Property(
     *                 property="date_of_birth",
     *                 type="string",
     *                 format="date",
     *                 example="1993-09-17"
     *             ),
     *             @OA\Property(
     *                 property="time_of_birth",
     *                 type="string",
     *                 format="time",
     *                 example="04:26:26 AM"
     *             ),
     *             @OA\Property(
     *                 property="age_in_yrs",
     *                 type="number",
     *                 format="float",
     *                 example=23.88
     *             ),
     *             @OA\Property(
     *                 property="date_of_joining",
     *                 type="string",
     *                 format="date",
     *                 example="2014-11-05"
     *             ),
     *             @OA\Property(
     *                 property="age_in_company",
     *                 type="number",
     *                 format="float",
     *                 example=2.73
     *             ),
     *             @OA\Property(
     *                 property="phone_number",
     *                 type="string",
     *                 example="231-704-4289"
     *             ),
     *             @OA\Property(
     *                 property="place_name",
     *                 type="string",
     *                 example="Dimondale"
     *             ),
     *             @OA\Property(
     *                 property="country",
     *                 type="string",
     *                 example="Eaton"
     *             ),
     *             @OA\Property(
     *                 property="city",
     *                 type="string",
     *                 example="Dimondale"
     *             ),
     *             @OA\Property(
     *                 property="zip",
     *                 type="integer",
     *                 example=48821
     *             ),
     *             @OA\Property(
     *                 property="region",
     *                 type="string",
     *                 example="Midwest"
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Employee not found"
     *     )
     * )
     */
    public function show(GetSingleEmployeeAction $action): JsonResponse
    {
        return $this->handleAction($action);
    }

    /**
     * @param UploadEmployeesAction $action
     *
     * @return JsonResponse
     *
     * @OA\Post(
     *     path="/api/v1/employee",
     *     summary="Upload Employee File",
     *     description="Upload Employee File.",
     *     tags={"Employees"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="file",
     *                     type="file",
     *                     description="Employee Csv File."
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="File uploaded successfully and will be imported soon.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="File uploaded successfully and will be imported soon."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="string", example="68fbdc1f-db93-4e6a-9e2d-a56b2be6d766"),
     *                 @OA\Property(property="filename", type="string", example="mcsDfAN0X57S9cbZ7UUDnN4HFcWfRZNf386SqdPP.csv")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="file", type="string", example="The file field is required.")
     *             )
     *         )
     *     )
     * )
     */
    public function store(UploadEmployeesAction $action): JsonResponse
    {
        return $this->handleAction($action);
    }

    /**
     * @param DeleteAnEmployeeAction $action
     * @param int $employee_id
     *
     * @return JsonResponse
     *
     * @OA\Delete(
     *     path="/api/v1/employee/{employee_id}",
     *     summary="Delete an employee by ID",
     *     tags={"Employees"},
     *     @OA\Parameter(
     *         name="employee_id",
     *         in="path",
     *         description="ID of the employee to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Employee deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Employee deleted successfully."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Employee not found"
     *     )
     * )
     */
    public function destroy(DeleteAnEmployeeAction $action): JsonResponse
    {
        return $this->handleAction($action);
    }
}
