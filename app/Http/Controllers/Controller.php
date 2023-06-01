<?php

namespace App\Http\Controllers;

use App\Traits\HasApiResponse;
use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private ?array $defaultSuccessData = ['success' => true];

    public function respondNotFound(Exception|string $message, ?string $key = 'error'): JsonResponse
    {
        return $this->apiResponse(
            [$key => $this->morphMessage($message)],
            Response::HTTP_NOT_FOUND,
        );
    }

    public function respondWithSuccess(array|JsonSerializable|Arrayable $contents = null): JsonResponse
    {
        $contents = $this->morphToArray($contents) ?? [];

        $data = [] === $contents
            ? $this->defaultSuccessData
            : $contents;

        return $this->apiResponse($data);
    }

    public function setDefaultSuccessResponse(?array $content = null): self
    {
        $this->defaultSuccessData = $content ?? [];

        return $this;
    }

    public function respondOk(string $message): JsonResponse
    {
        return $this->respondWithSuccess(['success' => $message]);
    }

    public function respondOkWithMessage(string $message): JsonResponse
    {
        return $this->respondWithSuccess(['message' => $message]);
    }

    public function respondUnAuthenticated(?string $message = null): JsonResponse
    {
        return $this->apiResponse(
            ['error' => $message ?? 'Unauthenticated'],
            Response::HTTP_UNAUTHORIZED,
        );
    }

    public function respondForbidden(?string $message = null): JsonResponse
    {
        return $this->apiResponse(
            ['error' => $message ?? 'Forbidden'],
            Response::HTTP_FORBIDDEN,
        );
    }

    public function respondError(?string $message = null): JsonResponse
    {
        return $this->apiResponse(
            ['error' => $message ?? 'Error'],
            Response::HTTP_UNPROCESSABLE_ENTITY,
        );
    }

    public function respondConflict(?string $message = null): JsonResponse
    {
        return $this->apiResponse(
            ['message' => $message ?? 'Resource already exists'],
            Response::HTTP_CONFLICT,
        );
    }

    public function respondCreated(array|JsonSerializable|Arrayable $data = null): JsonResponse
    {
        $data ??= [];

        return $this->apiResponse(
            $this->morphToArray($data),
            Response::HTTP_CREATED,
        );
    }

    public function respondFailedValidation($message, ?string $key = 'message'): JsonResponse
    {
        return $this->apiResponse(
            [$key => $this->morphMessage($message)],
            Response::HTTP_UNPROCESSABLE_ENTITY,
        );
    }

    public function respondTeapot(): JsonResponse
    {
        return $this->apiResponse(
            ['message' => 'I\'m a teapot'],
            Response::HTTP_I_AM_A_TEAPOT,
        );
    }

    public function respondNoContent(array|JsonSerializable|Arrayable $data = null): JsonResponse
    {
        $data ??= [];
        $data = $this->morphToArray($data);

        return $this->apiResponse($data, Response::HTTP_NO_CONTENT);
    }

    private function apiResponse(array $data, int $code = 200): JsonResponse
    {
        return response()->json($data, $code);
    }

    private function morphToArray(array|JsonSerializable|Arrayable|null $data): array|JsonSerializable|Arrayable|null
    {
        if ($data instanceof Arrayable) {
            return $data->toArray();
        }

        if ($data instanceof JsonSerializable) {
            return $data->jsonSerialize();
        }

        return $data;
    }

    private function morphMessage(Exception|string $message): string
    {
        return $message instanceof Exception
            ? $message->getMessage()
            : $message;
    }
}
