
/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Mvc;

use Phalcon\Mvc\Router\RouteInterface;
use Phalcon\Mvc\Router\GroupInterface;

/**
 * Interface for Phalcon\Mvc\Router
 */
interface RouterInterface
{
    /**
     * Attach Route object to the routes stack.
     */
    public function attach(<RouteInterface> route, var position = Router::POSITION_LAST) -> <RouterInterface>;

    /**
     * Removes all the defined routes
     */
    public function clear() -> void;

    /**
     * Returns processed action name
     */
    public function getActionName() -> string;

    /**
     * Returns processed controller name
     */
    public function getControllerName() -> string;

    /**
     * Returns the route that matches the handled URI
     */
    public function getMatchedRoute() -> <RouteInterface>;

    /**
     * Return the sub expressions in the regular expression matched
     */
    public function getMatches() -> array;

    /**
     * Returns processed module name
     */
    public function getModuleName() -> string;

    /**
     * Returns processed namespace name
     */
    public function getNamespaceName() -> string;

    /**
     * Returns processed extra params
     */
    public function getParams() -> array;

    /**
     * Return all the routes defined in the router
     */
    public function getRoutes() -> <RouteInterface[]>;

    /**
     * Returns a route object by its id
     */
    public function getRouteById(var id) -> <RouteInterface> | bool;

    /**
     * Returns a route object by its name
     */
    public function getRouteByName(string! name) -> <RouteInterface> | bool;

    /**
     * Handles routing information received from the rewrite engine
     */
    public function handle(string! uri) -> void;

    /**
     * Mounts a group of routes in the router
     */
    public function mount(<GroupInterface> group) -> <RouterInterface>;

    /**
     * Sets the default action name
     */
    public function setDefaultAction(string! actionName) -> <RouterInterface>;

    /**
     * Sets the default controller name
     */
    public function setDefaultController(string! controllerName) -> <RouterInterface>;

    /**
     * Sets the name of the default module
     */
    public function setDefaultModule(string! moduleName) -> <RouterInterface>;

    /**
     * Sets an array of default paths
     */
    public function setDefaults(array! defaults) -> <RouterInterface>;

    /**
     * Check if the router matches any of the defined routes
     */
    public function wasMatched() -> bool;
}
