<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Test\Integration\Mvc\Router;

use IntegrationTester;
use Phalcon\Mvc\Router\Group;
use Phalcon\Test\Fixtures\Traits\RouterTrait;

class GetRoutesCest
{
    use RouterTrait;

    /**
     * Tests Phalcon\Mvc\Router :: getRoutes()
     *
     * @author Sid Roberts <https://github.com/SidRoberts>
     * @since  2019-06-01
     */
    public function mvcRouterGetRoutes(IntegrationTester $I)
    {
        $I->wantToTest('Mvc\Router - getRoutes()');

        $router = $this->getRouter(false);

        $group = new Group();

        $getRoute = $group->addGet(
            '/docs/index',
            [
                'controller' => 'documentation4',
                'action'     => 'index',
            ]
        );

        $postRoute = $group->addPost(
            '/docs/index',
            [
                'controller' => 'documentation3',
                'action'     => 'index',
            ]
        );

        $router->mount($group);

        $I->assertCount(
            2,
            $router->getRoutes()
        );

        $I->assertEquals(
            [
                $getRoute,
                $postRoute,
            ],
            $router->getRoutes()
        );
    }
}
