<?php


namespace Tohidplus\JsonResponse\Tests\Unit;

use Tohidplus\JsonResponse\Contracts\ArrayJsonSerializable;
use Tohidplus\JsonResponse\Response;
use Tohidplus\JsonResponse\Tests\BaseTestClass;

class ResponseClassTest extends BaseTestClass
{
    /**
     * @test
     */
    public function it_is_a_json_serializable()
    {
        $response = new Response(
            $this->newComponent(),
            $this->newComponent(),
            "success",
            "200"
        );
        $this->assertInstanceOf(ArrayJsonSerializable::class, $response);
    }

    /**
     * @test
     */
    public function it_returns_result_and_error()
    {
        $response = new Response(
            $this->newComponent("foo", "bar"),
            $this->newComponent("foz", "baz"),
            "success",
            "200"
        );
        $this->assertEquals([
            "result" => [
                "data" => "foo",
                "meta" => "bar"
            ],
            "error" => [
                "data" => "foz",
                "meta" => "baz"
            ],
            "status" => "success",
            "statusCode" => 200
        ], $response->toArray());
    }

    /**
     * @test
     */
    public function it_does_not_return_error_if_is_empty()
    {
        $response = new Response(
            $this->newComponent("foo", "bar"),
            $this->newComponent(),
            "success",
            200
        );
        $this->assertArrayNotHasKey("error", $response->toArray());
    }

    /**
     * @test
     */
    public function it_does_not_return_result_if_is_empty()
    {
        $response = new Response(
            $this->newComponent(),
            $this->newComponent("foo", "bar"),
            "success",
            500
        );
        $this->assertArrayNotHasKey("result", $response->toArray());
    }

    /**
     * @test
     */
    public function it_returns_status_code()
    {
        $response = new Response(
            $this->newComponent(),
            $this->newComponent(),
            "success",
            500
        );
        $this->assertEquals(500, $response->getStatusCode());
    }
}
