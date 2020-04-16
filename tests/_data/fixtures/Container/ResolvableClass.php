<?php

namespace Phalcon\Test\Fixtures\Container;

class ResolvableClass
{
    public function __construct(string $hello, Incrementer $incrementer, string $parameter)
    {
        $this->hello       = $hello;
        $this->incrementer = $incrementer;
        $this->parameter   = $parameter;
    }
}
