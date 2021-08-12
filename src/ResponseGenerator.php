<?php


namespace Tohidplus\JsonResponse;

use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Http\JsonResponse;

/**
 * Class ResponseGenerator
 * @package Tohidplus\JsonResponse
 * @mixin AccessResponse
 */
class ResponseGenerator
{
    /**
     * @param mixed $data
     * @param mixed $meta
     * @param int $statusCode
     * @return JsonResponse
     */
    public function success($data = null, $meta = null, $statusCode = 200): JsonResponse
    {
        $params = [
            "result" => [
                "data" => $data,
                "meta" => $meta
            ],
            "status_code" => $statusCode
        ];
        return $this->toHttpResponse(app(Response::class, $params));
    }

    /**
     * @param mixed $data
     * @param mixed $meta
     * @param int $statusCode
     * @return JsonResponse
     */
    public function error($data, $meta = null, $statusCode = 500): JsonResponse
    {
        $params = [
            "error" => [
                "data" => $data,
                "meta" => $meta
            ],
            "status" => "error",
            "status_code" => $statusCode
        ];
        return $this->toHttpResponse(app(Response::class, $params));
    }

    /**
     * @param mixed $data
     * @param mixed $meta
     * @return JsonResponse
     */
    public function created($data, $meta = null): JsonResponse
    {
        return $this->success($data, $meta, 201);
    }

    /**
     * @param mixed $data
     * @param mixed $meta
     * @return JsonResponse
     */
    public function updated($data, $meta = null): JsonResponse
    {
        return $this->success($data, $meta, 200);
    }

    /**
     * @param int $statusCode
     * @param mixed $data
     * @param mixed $meta
     * @return JsonResponse
     */
    public function deleted(int $statusCode = 204, $data = null, $meta = null): JsonResponse
    {
        return $this->success($data, $meta, $statusCode);
    }

    /**
     * @param mixed $data
     * @param array $meta
     * @return JsonResponse
     */
    public function validationErrors(array $meta, $data = null): JsonResponse
    {
        return $this->error($data, $meta, 422);
    }

    /**
     * @param mixed $error
     * @param mixed $meta
     * @return JsonResponse
     */
    public function unauthorized($error = "Unauthorized", $meta = null): JsonResponse
    {
        return $this->error($error, $meta, 401);
    }

    /**
     * @param mixed|string $error
     * @param mixed|array $meta
     * @return JsonResponse
     */
    public function unauthenticated($error = "Unauthenticated", $meta = null): JsonResponse
    {
        return $this->error($error, $meta, 401);
    }

    /**
     * @param Response $response
     * @return JsonResponse
     */
    private function toHttpResponse(Response $response): JsonResponse
    {
        return response()->json($response, $response->getStatusCode());
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments): mixed
    {
        return AccessResponse::$name(...$arguments);
    }
}
