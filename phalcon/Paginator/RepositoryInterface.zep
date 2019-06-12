
/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Paginator;

/**
 * Phalcon\Paginator\RepositoryInterface
 *
 * Interface for the repository of current state
 * Phalcon\Paginator\AdapterInterface::paginate()
 */
interface RepositoryInterface
{
    /**
     * Gets number of the current page
     */
    public function getCurrent() -> int;

    /**
     * Gets number of the first page
     */
    public function getFirst() -> int;

    /**
     * Gets the items on the current page
     */
    public function getItems() -> var;

    /**
     * Gets number of the last page
     */
    public function getLast() -> int;

    /**
     * Gets current rows limit
     */
    public function getLimit() -> int;

    /**
     * Gets number of the next page
     */
    public function getNext() -> int;

    /**
     * Gets number of the previous page
     */
    public function getPrevious() -> int;

    /**
     * Gets the total number of items
     */
    public function getTotalItems() -> int;

    /**
     * Sets values for properties of the repository
     */
    public function setProperties(array properties) -> <RepositoryInterface>;
}
