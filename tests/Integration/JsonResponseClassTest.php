<?php

namespace Tohidplus\JsonResponse\Tests\Integration;

use Tohidplus\JsonResponse\Facades\JsonResponse;
use Tohidplus\JsonResponse\Tests\BaseTestClass;
use Tohidplus\JsonResponse\Tests\TestResponseGeneratorClassMethods;

class JsonResponseClassTest extends BaseTestClass
{
    use TestResponseGeneratorClassMethods;

    public function test_success_method()
    {
        $response = JsonResponse::success("foo", "bar");
        $this->successMethodTest($response, "foo", "bar");
    }

    public function test_error_method()
    {
        $response = JsonResponse::error("foo", "bar");
        $this->errorMethodTest($response, "foo", "bar");
    }

    public function test_created_method()
    {
        $response = JsonResponse::created(["foo", "bar"]);
        $this->createdMethodTest($response, ["foo", "bar"]);
    }

    public function test_updated_method()
    {
        $response = JsonResponse::updated(["foo", "bar"]);
        $this->updatedMethodTest($response, ["foo", "bar"]);
    }

    public function test_deleted_method()
    {
        $response = JsonResponse::deleted();
        $this->deletedMethodTest($response);
    }

    public function test_validationErrors_method()
    {
        $response = JsonResponse::validationErrors(["foo" => "bar"], "some message");
        $this->validationErrorsMethodTest($response, ["foo" => "bar"], "some message");
    }
    public function test_unauthenticated_method()
    {
        $response = JsonResponse::unauthenticated();
        $this->unauthenticatedMethodTest($response);
    }

    public function test_unauthorized_method()
    {
        $response = JsonResponse::unauthorized();
        $this->unauthorizedMethodTest($response);
    }
}
