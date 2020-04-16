<?php

namespace Phalcon\Test\Fixtures\Container\Services;

use Phalcon\Container\Service;

class InheritsHelloService extends Service
{
    public function getName() : string
    {
        return 'inheritsHello';
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve($hello)
    {
        return $hello;
    }
}
