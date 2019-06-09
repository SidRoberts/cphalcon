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

class GetRouteByNameCest
{
    use RouterTrait;

    /**
     * Tests Phalcon\Mvc\Router :: getRouteByName()
     *
     * @author Wojciech Ślawski <jurigag@gmail.com>
     * @since  2018-06-28
     */
    public function testGetRouteByName(IntegrationTester $I)
    {
        $I->wantToTest('Mvc\Router - getRouteByName()');

        $router = $this->getRouter(false);

        $group = new Group();

        $group->add('/test', ['controller' => 'test', 'action' => 'test'])->setName('test');
        $group->add('/test2', ['controller' => 'test', 'action' => 'test'])->setName('test2');
        $group->add('/test3', ['controller' => 'test', 'action' => 'test'])->setName('test3');

        $router->mount($group);

        /**
         * We reverse routes so we first check last added route
         */
        foreach (array_reverse($router->getRoutes()) as $route) {
            $expected = $router->getRouteByName($route->getName());
            $actual   = $route;

            $I->assertEquals($expected, $actual);
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
        $router = $this->getRouter(false);

        $group = new Group();

        $usersFind = $group->add('/api/users/find')->setHttpMethods('GET')->setName('usersFind');
        $usersAdd  = $group->add('/api/users/add')->setHttpMethods('POST')->setName('usersAdd');

        $router->mount($group);

        $I->assertEquals(
            $usersAdd,
            $router->getRouteByName('usersAdd')
        );

        // second check when the same route goes from name lookup
        $I->assertEquals(
            $usersAdd,
            $router->getRouteByName('usersAdd')
        );
    }
}
