
/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Paginator;

use JsonSerializable;
use Phalcon\Helper\Arr;

/**
 * Phalcon\Paginator\Repository
 *
 * Repository of current state Phalcon\Paginator\AdapterInterface::paginate()
 */
class Repository implements RepositoryInterface, JsonSerializable
{
    /**
     * @var array
     */
    protected properties = [];

    /**
     * {@inheritdoc}
     */
    public function getCurrent() -> int
    {
        return this->getProperty("current", 0);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirst() -> int
    {
        return this->getProperty("first", 0);
    }

    /**
     * {@inheritdoc}
     */
    public function getItems() -> var
    {
        return this->getProperty("items", null);
    }

    /**
     * {@inheritdoc}
     */
    public function getLast() -> int
    {
        return this->getProperty("last", 0);
    }

    /**
     * {@inheritdoc}
     */
    public function getLimit() -> int
    {
        return this->getProperty("limit", 0);
    }

    /**
     * {@inheritdoc}
     */
    public function getNext() -> int
    {
        return this->getProperty("next", 0);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrevious() -> int
    {
        return this->getProperty("previous", 0);
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalItems() -> int
    {
        return this->getProperty("total_items", 0);
    }

    /**
     * See [jsonSerialize](https://php.net/manual/en/jsonserializable.jsonserialize.php)
     */
    public function jsonSerialize() -> array
    {
        return this->properties;
    }

    /**
     * {@inheritdoc}
     */
    public function setProperties(array properties) -> <RepositoryInterface>
    {
        let this->properties = properties;

        return this;
    }

    /**
     * Gets value of property by name
     */
    protected function getProperty(string property, var defaultValue = null) -> var
    {
        return Arr::get(
            this->properties,
            property,
            defaultValue
        );
    }
}
