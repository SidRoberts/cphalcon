
/*
 +------------------------------------------------------------------------+
 | Phalcon Framework                                                      |
 +------------------------------------------------------------------------+
 | Copyright (c) 2011-2016 Phalcon Team (https://phalconphp.com)          |
 +------------------------------------------------------------------------+
 | This source file is subject to the New BSD License that is bundled     |
 | with this package in the file docs/LICENSE.txt.                        |
 |                                                                        |
 | If you did not receive a copy of the license and are unable to         |
 | obtain it through the world-wide-web, please send an email             |
 | to license@phalconphp.com so we can send you a copy immediately.       |
 +------------------------------------------------------------------------+
 | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
 |          Eduar Carvajal <eduar@phalconphp.com>                         |
 +------------------------------------------------------------------------+
 */

namespace Phalcon\Mvc\Model;

use Phalcon\DiInterface;
use Phalcon\Mvc\ModelInterface;

interface RepositoryInterface
{
	public function __construct(string! modelClass, <ManagerInterface> modelsManager);


	/**
	 * Finds a set of records that match the specified conditions
	 *
	 * <code>
	 * $robotsRepository = $modelsManager->getRepository(
	 *     Robots::class
	 * );
	 *
	 * // How many robots are there?
	 * $robots = $robotsRepository->find();
	 *
	 * echo "There are ", count($robots), "\n";
	 *
	 * // How many mechanical robots are there?
	 * $robots = $robotsRepository->find(
	 *     [
	 *         "type = 'mechanical'",
	 *     ]
	 * );
	 *
	 * echo "There are ", count($robots), "\n";
	 *
	 * // Get and print virtual robots ordered by name
	 * $robots = $robotsRepository->find(
	 *     [
	 *         "type = 'virtual'",
	 *         "order" => "name",
	 *     ]
	 * );
	 *
	 * foreach ($robots as $robot) {
	 *     echo $robot->name, "\n";
	 * }
	 *
	 * // Get first 100 virtual robots ordered by name
	 * $robots = $robotsRepository->find(
	 *     [
	 *         "type = 'virtual'",
	 *         "order" => "name",
	 *         "limit" => 100,
	 *     ]
	 * );
	 *
	 * foreach ($robots as $robot) {
	 *     echo $robot->name, "\n";
	 * }
	 * </code>
	 */
	public function find(array params = []) -> <ResultsetInterface>;

	/**
	 * Finds the first record that matches the specified conditions
	 *
	 * <code>
	 * $robotsRepository = $modelsManager->getRepository(
	 *     Robots::class
	 * );
	 *
	 * // What's the first robot in robots table?
	 * $robot = $robotsRepostory->findFirst();
	 *
	 * echo "The robot name is ", $robot->name;
	 *
	 * // What's the first mechanical robot in robots table?
	 * $robot = $robotsRepostory->findFirst(
	 *     [
	 *         "type = 'mechanical'",
	 *     ]
	 * );
	 *
	 * echo "The first mechanical robot name is ", $robot->name;
	 *
	 * // Get first virtual robot ordered by name
	 * $robot = $robotsRepostory->findFirst(
	 *     [
	 *         "type = 'virtual'",
	 *         "order" => "name",
	 *     ]
	 * );
	 *
	 * echo "The first virtual robot name is ", $robot->name;
	 * </code>
	 */
	public function findFirst(array params = []) -> <ModelInterface>;

	/**
	 * Allows to count how many records match the specified conditions
	 *
	 * <code>
	 * $robotsRepository = $modelsManager->getRepository(
	 *     Robots::class
	 * );
	 *
	 * // How many robots are there?
	 * $number = $robotsRepository->count();
	 *
	 * echo "There are ", $number, "\n";
	 *
	 * // How many mechanical robots are there?
	 * $number = $robotsRepository->count(
	 *     [
	 *         "type = 'mechanical'",
	 *     ]
	 * );
	 *
	 * echo "There are ", $number, " mechanical robots\n";
	 * </code>
	 */
	public function count(array parameters = []) -> int;

	/**
	 * Allows to calculate a sum on a column that match the specified conditions
	 *
	 * <code>
	 * $robotsRepository = $modelsManager->getRepository(
	 *     Robots::class
	 * );
	 *
	 * // How much are all robots?
	 * $sum = $robotsRepository->sum(
	 *     [
	 *         "column" => "price",
	 *     ]
	 * );
	 *
	 * echo "The total price of robots is ", $sum, "\n";
	 *
	 * // How much are mechanical robots?
	 * $sum = $robotsRepository->sum(
	 *     [
	 *         "type = 'mechanical'",
	 *         "column" => "price",
	 *     ]
	 * );
	 *
	 * echo "The total price of mechanical robots is  ", $sum, "\n";
	 * </code>
	 *
	 * @return mixed
	 */
	public function sum(array parameters = []);

	/**
	 * Allows to get the maximum value of a column that match the specified conditions
	 *
	 * <code>
	 * $robotsRepository = $modelsManager->getRepository(
	 *     Robots::class
	 * );
	 *
	 * // What is the maximum robot id?
	 * $id = $robotsRepository->maximum(
	 *     [
	 *         "column" => "id",
	 *     ]
	 * );
	 *
	 * echo "The maximum robot id is: ", $id, "\n";
	 *
	 * // What is the maximum id of mechanical robots?
	 * $sum = $robotsRepository->maximum(
	 *     [
	 *         "type = 'mechanical'",
	 *         "column" => "id",
	 *     ]
	 * );
	 *
	 * echo "The maximum robot id of mechanical robots is ", $id, "\n";
	 * </code>
	 *
	 * @return mixed
	 */
	public function maximum(array parameters = []);

	/**
	 * Allows to get the minimum value of a column that match the specified conditions
	 *
	 * <code>
	 * $robotsRepository = $modelsManager->getRepository(
	 *     Robots::class
	 * );
	 *
	 * // What is the minimum robot id?
	 * $id = $robotsRepository->minimum(
	 *     [
	 *         "column" => "id",
	 *     ]
	 * );
	 *
	 * echo "The minimum robot id is: ", $id;
	 *
	 * // What is the minimum id of mechanical robots?
	 * $sum = $robotsRepository->minimum(
	 *     [
	 *         "type = 'mechanical'",
	 *         "column" => "id",
	 *     ]
	 * );
	 *
	 * echo "The minimum robot id of mechanical robots is ", $id;
	 * </code>
	 *
	 * @return mixed
	 */
	public function minimum(array parameters = []);

	/**
	 * Allows to calculate the average value on a column matching the specified conditions
	 *
	 * <code>
	 * $robotsRepository = $modelsManager->getRepository(
	 *     Robots::class
	 * );
	 *
	 * // What's the average price of robots?
	 * $average = $robotsRepository->average(
	 *     [
	 *         "column" => "price",
	 *     ]
	 * );
	 *
	 * echo "The average price is ", $average, "\n";
	 *
	 * // What's the average price of mechanical robots?
	 * $average = $robotsRepository->average(
	 *     [
	 *         "type = 'mechanical'",
	 *         "column" => "price",
	 *     ]
	 * );
	 *
	 * echo "The average price of mechanical robots is ", $average, "\n";
	 * </code>
	 *
	 * @return double
	 */
	public function average(array parameters = []);

	/**
	 * Create a criteria for a specific model
	 */
	public function query(<DiInterface> dependencyInjector = null) -> <CriteriaInterface>;
}
