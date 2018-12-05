<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Test\Unit\Dispatcher;

use UnitTester;

class GetModuleNameCest
{
    /**
     * Tests Phalcon\Dispatcher :: getModuleName()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function dispatcherGetModuleName(UnitTester $I)
    {
        $I->wantToTest("Dispatcher - getModuleName()");
        $I->skipTest("Need implementation");
    }
}
