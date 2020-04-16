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

namespace Phalcon\Test\Integration\Validation;

use IntegrationTester;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class GetFiltersForCest
{
    /**
     * Tests Phalcon\Validation :: getFiltersFor()
     *
     * @author Sid Roberts <https://github.com/SidRoberts>
     * @since  2019-05-27
     */
    public function validationGetFiltersFor(IntegrationTester $I)
    {
        $I->wantToTest('Validation - getFiltersFor()');

        $validation = new Validation();

        $validation->add(
            'name',
            new PresenceOf()
        );

        $validation->add(
            'email',
            new PresenceOf()
        );

        $validation->setFilters('name', 'trim');
        $validation->setFilters('email', 'lower');

        $I->assertEquals(
            'trim',
            $validation->getFiltersFor('name')
        );

        $I->assertEquals(
            'lower',
            $validation->getFiltersFor('email')
        );
    }
}
