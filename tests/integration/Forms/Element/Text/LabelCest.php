<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Test\Integration\Forms\Element\Text;

use IntegrationTester;

/**
 * Class LabelCest
 */
class LabelCest
{
    /**
     * Tests Phalcon\Forms\Element\Text :: label()
     *
     * @author Phalcon Team <team@phalcon.io>
     * @since  2018-11-13
     */
    public function formsElementTextLabel(IntegrationTester $I)
    {
        $I->wantToTest('Forms\Element\Text - label()');
        $I->skipTest('Need implementation');
    }
}