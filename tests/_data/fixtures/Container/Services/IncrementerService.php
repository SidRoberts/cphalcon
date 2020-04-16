<?php

namespace Phalcon\Test\Fixtures\Container\Services;

use Phalcon\Container\Service;
use Phalcon\Test\Fixtures\Container\Incrementer;

class IncrementerService extends Service
{
    protected $isShared;



    public function __construct(bool $isShared)
    {
        $this->isShared = $isShared;
    }



    public function getName() : string
    {
        return 'incrementer';
    }

    public function isShared() : bool
    {
        return $this->isShared;
    }

    public function resolve()
    {
        $incrementer = new Incrementer();

        return $incrementer;
    }
}
