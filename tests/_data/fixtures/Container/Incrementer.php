<?php

namespace Phalcon\Test\Fixtures\Container;

class Incrementer
{
    protected $i = 0;



    public function increment()
    {
        $this->i++;
    }



    public function getI()
    {
        return $this->i;
    }
}
