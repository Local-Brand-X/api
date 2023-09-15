<?php

namespace App\Http\Actions;

use App\Http\Responses\StatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorObject;

abstract class Action
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var array<string, mixed>
     */
    protected array $validationErrors = [];

    /**
     * @var ValidatorObject
     */
    protected ValidatorObject $validator;

    /**
     * @var int
     */
    protected int $per_page;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->per_page = $request->per_page ?? 15;
    }

    final public function validate(): bool
    {
        $route = $this->request->route();
        if (null !== $route) {
            $this->request->merge($route->parameters());
        }

        $this->validator = Validator::make(
            $this->request->all(),
            $this->rules()
        );

        $paginationValidator = Validator::make(
            $this->request->all(),
            [
                'paginated' => 'boolean',
                'per_page' => 'integer|min:1',
            ]
        );

        if ($this->validator->passes() && $paginationValidator->passes()) {
            return true;
        }

        $this->validationErrors = array_merge(
            $this->validator->getMessageBag()->messages(),
            $paginationValidator->getMessageBag()->messages()
        );

        return false;
    }

    /**
     * @return JsonResponse
     */
    abstract public function execute(): JsonResponse;

    /**
     * @return array<string, string[]>
     */
    protected function rules(): array
    {
        return [];
    }

    /**
     * @param array<string, mixed>  $data
     * @param ?string               $message
     * @param ?array<string, mixed> $meta
     * @param StatusCode            $statusCode
     *
     * @return JsonResponse
     */
    protected function dataResponse(
        array $data,
        string $message = null,
        ?array $meta = [],
        StatusCode $statusCode = StatusCode::OK
    ): JsonResponse {
        return new JsonResponse(
            array_filter([
                'message' => $message,
                'data' => $data,
                'meta' => array_filter((array) $meta),
            ]),
            $statusCode->value
        );
    }

    /**
     * @return array<string, string[]>
     */
    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}
