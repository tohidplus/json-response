<?php


namespace Tohidplus\JsonResponse\Tests;


use Illuminate\Http\JsonResponse as LaravelJsonResponse;


trait TestResponseGeneratorClassMethods
{

    /**
     * @param LaravelJsonResponse $response
     * @param null $data
     * @param null $meta
     */
    public function successMethodTest(LaravelJsonResponse $response, $data = null, $meta = null)
    {
        $content = json_decode($response->getContent(), true);
        $this->assertEquals([
            "status" => "success",
            "statusCode" => 200,
            "result" => [
                "data" => $data,
                "meta" => $meta
            ]
        ], $content);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @param LaravelJsonResponse $response
     * @param null $data
     * @param null $meta
     */
    public function errorMethodTest(LaravelJsonResponse $response, $data = null, $meta = null)
    {
        $content = json_decode($response->getContent(), true);
        $this->assertEquals([
            "status" => "error",
            "statusCode" => 500,
            "error" => [
                "data" => $data,
                "meta" => $meta
            ]
        ], $content);
        $this->assertEquals(500, $response->getStatusCode());
    }

    /**
     * @param LaravelJsonResponse $response
     * @param $data
     * @param null $meta
     */
    public function createdMethodTest(LaravelJsonResponse $response, $data, $meta = null)
    {
        $content = json_decode($response->getContent(), true);
        $this->assertEquals([
            "status" => "success",
            "statusCode" => 201,
            "result" => [
                "data" => $data,
                "meta" => $meta
            ]
        ], $content);
        $this->assertEquals(201, $response->getStatusCode());
    }

    /**
     * @param LaravelJsonResponse $response
     * @param null $data
     * @param null $meta
     */
    public function updatedMethodTest(LaravelJsonResponse $response, $data = null, $meta = null)
    {
        $content = json_decode($response->getContent(), true);
        $this->assertEquals([
            "status" => "success",
            "statusCode" => 200,
            "result" => [
                "data" => $data,
                "meta" => $meta
            ]
        ], $content);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @param LaravelJsonResponse $response
     */
    public function deletedMethodTest(LaravelJsonResponse $response)
    {
        $content = json_decode($response->getContent(), true);
        $this->assertEquals([
            "status" => "success",
            "statusCode" => 204
        ], $content);
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function validationErrorsMethodTest(LaravelJsonResponse $response, $meta, $data = null)
    {
        $content = json_decode($response->getContent(), true);
        $this->assertEquals([
            "status" => "error",
            "statusCode" => 422,
            "error" => [
                "data" => $data,
                "meta" => $meta
            ]
        ], $content);
        $this->assertEquals(422, $response->getStatusCode());
    }

    public function unauthenticatedMethodTest(LaravelJsonResponse $response)
    {
        $content = json_decode($response->getContent(), true);
        $this->assertEquals([
            "status" => "error",
            "statusCode" => 401,
            "error" => [
                "data" => "Unauthenticated",
                "meta" => null
            ]
        ], $content);
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function unauthorizedMethodTest(LaravelJsonResponse $response)
    {
        $content = json_decode($response->getContent(), true);
        $this->assertEquals([
            "status" => "error",
            "statusCode" => 401,
            "error" => [
                "data" => "Unauthorized",
                "meta" => null
            ]
        ], $content);
        $this->assertEquals(401, $response->getStatusCode());
    }
}
