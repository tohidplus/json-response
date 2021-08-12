<?php


namespace Tohidplus\JsonResponse\Tests\Unit;

use Tohidplus\JsonResponse\Contracts\ArrayJsonSerializable;
use Tohidplus\JsonResponse\Tests\BaseTestClass;

class ComponentClassTest extends BaseTestClass
{

    /**
     * @test
     */
    public function it_is_a_array_json_serializable()
    {
        $component = $this->newComponent();
        $this->assertInstanceOf(ArrayJsonSerializable::class, $component);
    }

    /**
     * @test
     */
    public function it_returns_data_and_meta()
    {
        $component = $this->newComponent("foo", "bar");
        $this->assertEquals([
            "data" => "foo",
            "meta" => "bar"
        ], $component->toArray());
    }

    /**
     * @test
     */
    public function it_returns_empty_array_if_both_meta_and_data_are_empty()
    {
        $component = $this->newComponent();
        $this->assertEquals([], $component->toArray());
    }
}
