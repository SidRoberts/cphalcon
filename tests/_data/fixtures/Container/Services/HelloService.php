<?php

namespace Phalcon\Test\Fixtures\Container\Services;

use Phalcon\Container\Service;

class HelloService extends Service
{
    public function getName() : string
    {
        return 'hello';
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve()
    {
        return 'hello';
    }
}
