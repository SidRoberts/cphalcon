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

class IsTransactionCest
{
    /**
     * Tests Phalcon\Logger\Adapter\Syslog :: isTransaction()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function loggerAdapterSyslogIsTransaction(UnitTester $I)
    {
        $I->wantToTest("Logger\Adapter\Syslog - isTransaction()");
        $I->skipTest("Need implementation");
    }
}
