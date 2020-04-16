<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Test\Unit\Container\Container;

use Phalcon\Container\Container;
use Phalcon\Test\Fixtures\Container\Services\HelloService;
use UnitTester;

class HasCest
{
    /**
     * Unit Tests Phalcon\Container\Container :: has()
     *
     * @author Sid Roberts <https://github.com/SidRoberts>
     * @since  2019-06-09
     */
    public function containerContainerHas(UnitTester $I)
    {
        $I->wantToTest('Container\Container - has()');

        $container = new Container();

        $container->add(
            new HelloService()
        );



        $I->assertTrue(
            $container->has('hello')
        );

        $I->assertFalse(
            $container->has('doesntExist')
        );
    }
}
