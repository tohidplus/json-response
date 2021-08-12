<?php

namespace Tohidplus\JsonResponse\Tests\Unit;

use Tohidplus\JsonResponse\Contracts\ArrayJsonSerializable;
use Tohidplus\JsonResponse\Input;
use Tohidplus\JsonResponse\Tests\BaseTestClass;

class InputClassTest extends BaseTestClass
{
    /**
     * @test
     */
    public function it_is_a_array_json_serializable()
    {
        $input = new Input();
        $this->assertInstanceOf(ArrayJsonSerializable::class, $input);
    }

    /**
     * @test
     */
    public function it_returns_its_value()
    {
        $input = $this->newInput("value");
        $this->assertEquals("value", $input->toArray());
    }

    /**
     * @test
     */
    public function it_accepts_all_data_types()
    {
        // String
        $input = $this->newInput("value");
        $this->assertEquals("value", $input->toArray());

        //Integer
        $input = $this->newInput(1);
        $this->assertEquals(1, $input->toArray());

        //Float
        $input = $this->newInput(1.99);
        $this->assertEquals(1.99, $input->toArray());

        //Boolean
        $input = $this->newInput(true);
        $this->assertEquals(true, $input->toArray());

        //Array
        $input = $this->newInput(["foo" => "bar"]);
        $this->assertEquals(["foo" => "bar"], $input->toArray());

        //Object
        $obj = new \stdClass();
        $obj->first_name = "John";
        $obj->last_name = "Doe";
        $input = $this->newInput($obj);
        $this->assertEquals([
            "first_name" => "John",
            "last_name" => "Doe"
        ], $input->toArray());
    }

}
