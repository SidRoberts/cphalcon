<?php

namespace Phalcon\Test\Unit\Container;

use Phalcon\Container\Container;
use Phalcon\Container\RawService;
use Phalcon\Test\Fixtures\Container\Services\HelloService;
use Phalcon\Test\Fixtures\Container\Services\IncrementerService;
use Phalcon\Test\Fixtures\Container\Services\InheritsHelloService;
use Phalcon\Test\Fixtures\Container\Services\ParameterService;
use Phalcon\Test\Fixtures\Container\Services\TypeHintedResolverService;
use UnitTester;

class ContainerCest
{
    public function testBasic(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new HelloService()
        );



        $I->assertEquals(
            'hello',
            $container->get('hello')
        );
    }



    public function testInheritance(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new HelloService()
        );

        $container->add(
            new InheritsHelloService()
        );



        $I->assertEquals(
            'hello',
            $container->get('hello')
        );

        $I->assertEquals(
            'hello',
            $container->get('inheritsHello')
        );
    }



    public function testServiceWithAParameter(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new ParameterService('Sid')
        );



        $I->assertEquals(
            'Hello Sid',
            $container->get('parameter')
        );
    }



    public function testSingleton(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new IncrementerService(false)
        );



        $I->assertEquals(
            0,
            $container->get('incrementer')->getI()
        );

        $container->get('incrementer')->increment();

        $I->assertEquals(
            0,
            $container->get('incrementer')->getI()
        );
    }



    public function testShared(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new IncrementerService(true)
        );



        $I->assertEquals(
            0,
            $container->get('incrementer')->getI()
        );

        $container->get('incrementer')->increment();

        $I->assertEquals(
            1,
            $container->get('incrementer')->getI()
        );
    }



    public function testRawService(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new RawService(
                'example',
                true,
                function (Container $container) {
                    return 'hello';
                }
            )
        );



        $I->assertTrue(
            $container->has('example')
        );

        $I->assertEquals(
            'hello',
            $container->get('example')
        );
    }



    public function testTypeHintedResolver(UnitTester $I)
    {
        $container = new Container();

        $container->add(
            new TypeHintedResolverService()
        );

        $container->add(
            new ParameterService('Sid')
        );



        $I->assertEquals(
            "The 'parameter' service says: Hello Sid",
            $container->get('typeHintedResolver')
        );
    }
}
