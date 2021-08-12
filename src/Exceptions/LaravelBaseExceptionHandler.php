<?php


namespace Tohidplus\JsonResponse\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse as LaravelJsonResponse;
use Tohidplus\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LaravelBaseExceptionHandler extends ExceptionHandler
{
    use PrepareJsonResponse;

    /**
     * @param Request $request
     * @param ValidationException $exception
     * @return LaravelJsonResponse
     */
    protected function invalidJson($request, ValidationException $exception): LaravelJsonResponse
    {
        return JsonResponse::validationErrors($exception->errors(), $exception->getMessage());
    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? JsonResponse::unauthenticated()
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }
}
