<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Test\Integration\Session\Adapter\Libmemcached;

use IntegrationTester;

class RegenerateIdCest
{
    /**
     * Tests Phalcon\Session\Adapter\Libmemcached :: regenerateId()
     *
     * @param IntegrationTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function sessionAdapterLibmemcachedRegenerateId(IntegrationTester $I)
    {
        $I->wantToTest("Session\Adapter\Libmemcached - regenerateId()");
        $I->skipTest("Need implementation");
    }
}
