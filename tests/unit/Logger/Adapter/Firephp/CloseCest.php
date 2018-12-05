<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Test\Unit\Logger\Adapter\Firephp;

use UnitTester;

class CloseCest
{
    /**
     * Tests Phalcon\Logger\Adapter\Firephp :: close()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function loggerAdapterFirephpClose(UnitTester $I)
    {
        $I->wantToTest("Logger\Adapter\Firephp - close()");
        $I->skipTest("Need implementation");
    }
}
