<?php


namespace Tohidplus\JsonResponse\Tests\Unit;

use Illuminate\Http\JsonResponse as LaravelJsonResponse;
use Tohidplus\JsonResponse\Response;
use Tohidplus\JsonResponse\ResponseGenerator;
use Tohidplus\JsonResponse\Tests\BaseTestClass;
use Tohidplus\JsonResponse\Tests\TestResponseGeneratorClassMethods;

class ResponseGeneratorClassTest extends BaseTestClass
{
    use TestResponseGeneratorClassMethods;

    /**
     * @var ResponseGenerator
     */
    private ResponseGenerator $responseGenerator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->responseGenerator = new ResponseGenerator();
    }

    public function test_success_method()
    {
        $response = $this->responseGenerator->success("foo", "bar");
        $this->successMethodTest($response, "foo", "bar");
    }

    public function test_error_method()
    {
        $response = $this->responseGenerator->error("foo", "bar");
        $this->errorMethodTest($response, "foo", "bar");
    }

    public function test_created_method()
    {
        $response = $this->responseGenerator->created(["foo" => "bar"]);
        $this->createdMethodTest($response, ["foo" => "bar"]);
    }

    public function test_updated_method()
    {
        $response = $this->responseGenerator->updated(["foo" => "bar"]);
        $this->updatedMethodTest($response, ["foo" => "bar"]);
    }

    public function test_deleted_method()
    {
        $response = $this->responseGenerator->deleted();
        $this->deletedMethodTest($response);
    }

    public function test_validationErrors_method()
    {
        $response = $this->responseGenerator->validationErrors(["foo" => "bar"], "some message");
        $this->validationErrorsMethodTest($response, ["foo" => "bar"], "some message");
    }

    public function test_unauthenticated_method()
    {
        $response = $this->responseGenerator->unauthenticated();
        $this->unauthenticatedMethodTest($response);
    }

    public function test_unauthorized_method()
    {
        $response = $this->responseGenerator->unauthorized();
        $this->unauthorizedMethodTest($response);
    }

    public function test_toHttpResponse_method()
    {
        $response = new Response(
            $this->newComponent("foo"),
            $this->newComponent(),
            "success",
            200
        );
        $result = $this->invokePrivateMethod(ResponseGenerator::class, "toHttpResponse", [$response]);
        $this->assertInstanceOf(LaravelJsonResponse::class, $result);
    }

}
