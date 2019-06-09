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
use Phalcon\Mvc\Router\Route;
use Phalcon\Test\Fixtures\Traits\RouterTrait;

class GetRouteByIdCest
{
    use RouterTrait;

    /**
     * Tests Phalcon\Mvc\Router :: getRouteById()
     *
     * @author Wojciech Ślawski <jurigag@gmail.com>
     * @since  2018-06-28
     */
    public function testGetRouteById(IntegrationTester $I)
    {
        $I->wantToTest('Mvc\Router - getRouteById()');

        $router = $this->getRouter(false);

        $group = new Group();

        $group->add(
            '/test',
            [
                'controller' => 'test',
                'action'     => 'test',
            ]
        );

        $group->add(
            '/test2',
            [
                'controller' => 'test',
                'action'     => 'test',
            ]
        );

        $group->add(
            '/test3',
            [
                'controller' => 'test',
                'action'     => 'test',
            ]
        );

        $router->mount($group);

        /**
         * We reverse routes so we first check last added route
         */
        foreach (array_reverse($router->getRoutes()) as $route) {
            $actual = $router->getRoutebyId(
                $route->getId()
            );

            $I->assertEquals($route, $actual);
        }
    }

    /**
     * Tests getting named route
     *
     * @author Andy Gutierrez <andres.gutierrez@phalcon.io>
     * @since  2012-08-27
     */
    public function testGettingNamedRoutes(IntegrationTester $I)
    {
        Route::reset();

        $router = $this->getRouter(false);

        $group = new Group();

        $usersFind = $group->add('/api/users/find')->setHttpMethods('GET')->setName('usersFind');
        $usersAdd  = $group->add('/api/users/add')->setHttpMethods('POST')->setName('usersAdd');

        $router->mount($group);

        $I->assertEquals(
            $usersFind,
            $router->getRouteById(0)
        );

        $I->assertEquals(
            $usersAdd,
            $router->getRouteById(1)
        );
    }
}
