<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Test\Unit\Logger\Adapter\Syslog;

use UnitTester;

class CriticalCest
{
    /**
     * Tests Phalcon\Logger\Adapter\Syslog :: critical()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function loggerAdapterSyslogCritical(UnitTester $I)
    {
        $I->wantToTest("Logger\Adapter\Syslog - critical()");
        $I->skipTest("Need implementation");
    }
}
