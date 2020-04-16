<?php

namespace Phalcon\Test\Unit\Container;

use Phalcon\Container\Container;
use Phalcon\Container\Resolver;
use Phalcon\Test\Fixtures\Container\ResolvableClass;
use Phalcon\Test\Fixtures\Container\Services\HelloService;
use Phalcon\Test\Fixtures\Container\Services\IncrementerService;
use Phalcon\Test\Fixtures\Container\Services\ParameterService;
use UnitTester;

class ResolverCest
{
    public function testTypehintClass(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new HelloService()
        );

        $container->add(
            new ParameterService('Sid')
        );

        $container->add(
            new IncrementerService(true)
        );



        $resolver = new Resolver($container);



        $typehintedClass = $resolver->typehintClass(
            ResolvableClass::class
        );



        $I->assertEquals(
            'hello',
            $typehintedClass->hello
        );

        $I->assertEquals(
            'Hello Sid',
            $typehintedClass->parameter
        );

        $I->assertEquals(
            0,
            $typehintedClass->incrementer->getI()
        );
    }
}
