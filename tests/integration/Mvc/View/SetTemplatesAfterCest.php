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

namespace Phalcon\Test\Integration\Mvc\View;

use IntegrationTester;

class SetTemplatesAfterCest
{
    /**
     * Tests Phalcon\Mvc\View :: setTemplatesAfter()
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function mvcViewSetTemplatesAfter(IntegrationTester $I)
    {
        $I->wantToTest('Mvc\View - setTemplatesAfter()');

        $I->skipTest('Need implementation');
    }
}
