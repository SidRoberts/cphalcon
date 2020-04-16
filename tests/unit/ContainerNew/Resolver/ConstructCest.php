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

class ConstructCest
{
    /**
     * Unit Tests Phalcon\Container\Resolver :: __construct()
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2019-06-09
     */
    public function containerResolverConstruct(UnitTester $I)
    {
        $I->wantToTest('Container\Resolver - __construct()');

        $I->skipTest('Need implementation');
    }
}
