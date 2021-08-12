<?php

namespace Tohidplus\JsonResponse\Tests;

use Orchestra\Testbench\TestCase;
use Tohidplus\JsonResponse\Component;
use Tohidplus\JsonResponse\Input;
use Tohidplus\JsonResponse\JsonResponseServiceProvider;

class BaseTestClass extends TestCase
{
    use InvokablePrivateMethod;

    protected function getPackageProviders($app)
    {
        return [JsonResponseServiceProvider::class];
    }

    /**
     * @param $input
     * @return Input
     */
    protected function newInput($input = null): Input
    {
        return new Input($input);
    }

    /**
     * @param $data
     * @param $meta
     * @return Component
     */
    public function newComponent($data = null, $meta = null): Component
    {
        return new Component(
            $this->newInput($data),
            $this->newInput($meta)
        );
    }
}
