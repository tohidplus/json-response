<?php


namespace Tohidplus\JsonResponse\Exceptions;

use Illuminate\Http\JsonResponse as LaravelJsonResponse;
use Tohidplus\JsonResponse\Facades\JsonResponse;
use Throwable;

trait PrepareJsonResponse
{

    protected function prepareJsonResponse($request, Throwable $e): LaravelJsonResponse
    {
        $meta = $this->convertExceptionToArray($e);
        $message = $meta['message'];
        unset($meta['message']);
        return JsonResponse::error(
            $message,
            $meta,
            $this->isHttpException($e) ? $e->getStatusCode() : 500
            );
    }
}
