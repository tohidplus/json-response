<?php


namespace Tohidplus\JsonResponse\Tests;

use ReflectionClass;
use ReflectionException;

trait InvokablePrivateMethod
{
    /**
     * @param string $class
     * @param string $method
     * @param array $parameters
     * @param array $constructorParameters
     * @return mixed
     * @throws ReflectionException
     */
    public function invokePrivateMethod(string $class, string $method, array $parameters = [], array $constructorParameters = [])
    {
        $c = new ReflectionClass($class);
        $method = $c->getMethod($method);
        $method->setAccessible(true);
        $obj = new $class(...$constructorParameters);
        return $method->invokeArgs($obj,$parameters);
    }
}
