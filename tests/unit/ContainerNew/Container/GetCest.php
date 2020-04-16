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
use Phalcon\Container\Exception\ServiceNotFoundException;
use UnitTester;

class GetCest
{
    /**
     * Unit Tests Phalcon\Container\Container :: get()
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2019-06-09
     */
    public function containerContainerGet(UnitTester $I)
    {
        $I->wantToTest('Container\Container - get()');

        $I->skipTest('Need implementation');
    }

    /**
     * @author Sid Roberts <https://github.com/SidRoberts>
     * @since  2019-06-09
     */
    public function testServiceDoesntExist(UnitTester $I)
    {
        $container = new Container();

        $I->expectException(
            ServiceNotFoundException::class,
            function () use ($container) {
                $container->get('serviceThatDoesntExist');
            }
        );
    }
}
