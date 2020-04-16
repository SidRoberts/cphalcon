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

namespace Phalcon\Test\Unit\Container\Resolver;

use UnitTester;

class TypehintClassCest
{
    /**
     * Unit Tests Phalcon\Container\Resolver :: typehintClass()
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2019-06-09
     */
    public function containerResolverTypehintClass(UnitTester $I)
    {
        $I->wantToTest('Container\Resolver - typehintClass()');

        $I->skipTest('Need implementation');
    }
}
