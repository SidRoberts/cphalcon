
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

use Phalcon\Mvc\ModelInterface;
use Phalcon\Di;
use Phalcon\DiInterface;

/**
 * Phalcon\Mvc\Model\Repository
 */
class Repository implements RepositoryInterface
{

	/**
	 * @var string
	 */
	protected _modelClass;

	protected _modelsManager;



	public function __construct(string! modelClass, <ManagerInterface> modelsManager)
	{
		let this->_modelClass = modelClass;
		let this->_modelsManager = modelsManager;
	}



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
	public function find(array params = []) -> <ResultsetInterface>
	{
		var builder, query, bindParams, bindTypes, cache, resultset, hydration;

		/**
		 * Builds a query with the passed parameters
		 */
		let builder = this->_modelsManager->createBuilder(params);
		builder->from(this->_modelClass);

		let query = builder->getQuery();

		/**
		 * Check for bind parameters
		 */
		if fetch bindParams, params["bind"] {

			if typeof bindParams == "array" {
				query->setBindParams(bindParams, true);
			}

			if fetch bindTypes, params["bindTypes"] {
				if typeof bindTypes == "array" {
					query->setBindTypes(bindTypes, true);
				}
			}
		}

		/**
		 * Pass the cache options to the query
		 */
		if fetch cache, params["cache"] {
			query->cache(cache);
		}

		/**
		 * Execute the query passing the bind-params and casting-types
		 */
		let resultset = query->execute();

		/**
		 * Define an hydration mode
		 */
		if typeof resultset == "object" {
			if fetch hydration, params["hydration"] {
				resultset->setHydrateMode(hydration);
			}
		}

		return resultset;
	}

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
	public function findFirst(array params = []) -> <ModelInterface>
	{
		var builder, query, bindParams, bindTypes, cache;

		/**
		 * Builds a query with the passed parameters
		 */
		let builder = this->_modelsManager->createBuilder(params);
		builder->from(this->_modelClass);

		/**
		 * We only want the first record
		 */
		builder->limit(1);

		let query = builder->getQuery();

		/**
		 * Check for bind parameters
		 */
		if fetch bindParams, params["bind"] {

			if typeof bindParams == "array" {
				query->setBindParams(bindParams, true);
			}

			if fetch bindTypes, params["bindTypes"] {
				if typeof bindTypes == "array" {
					query->setBindTypes(bindTypes, true);
				}
			}
		}

		/**
		 * Pass the cache options to the query
		 */
		if fetch cache, params["cache"] {
			query->cache(cache);
		}

		/**
		 * Return only the first row
		 */
		query->setUniqueRow(true);

		/**
		 * Execute the query passing the bind-params and casting-types
		 */
		return query->execute();
	}

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
	public function count(array parameters = []) -> int
	{
		var result;

		let result = this->_groupResult("COUNT", "rowcount", parameters);

		if typeof result == "string" {
			return (int) result;
		}

		return result;
	}

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
	public function sum(array parameters = [])
	{
		return this->_groupResult("SUM", "sumatory", parameters);
	}

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
	public function maximum(array parameters = [])
	{
		return this->_groupResult("MAX", "maximum", parameters);
	}

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
	public function minimum(array parameters = [])
	{
		return this->_groupResult("MIN", "minimum", parameters);
	}

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
	public function average(array parameters = [])
	{
		return this->_groupResult("AVG", "average", parameters);
	}

	/**
	 * Generate a PHQL SELECT statement for an aggregate
	 */
	protected function _groupResult(string! functionName, string! alias, array parameters) -> <ResultsetInterface>
	{
		var distinctColumn, groupColumn, columns,
			bindParams, bindTypes, resultset, cache, firstRow, groupColumns,
			builder, query;

		if !fetch groupColumn, parameters["column"] {
			let groupColumn = "*";
		}

		/**
		 * Builds the columns to query according to the received parameters
		 */
		if fetch distinctColumn, parameters["distinct"] {
			let columns = functionName . "(DISTINCT " . distinctColumn . ") AS " . alias;
		} else {
			if fetch groupColumns, parameters["group"] {
				let columns = groupColumns . ", " . functionName . "(" . groupColumn . ") AS " . alias;
			} else {
				let columns = functionName . "(" . groupColumn . ") AS " . alias;
			}
		}

		/**
		 * Builds a query with the passed parameters
		 */
		let builder = this->_modelsManager->createBuilder(parameters);
		builder->columns(columns);
		builder->from(this->_modelClass);

		let query = builder->getQuery();

		/**
		 * Check for bind parameters
		 */
		let bindParams = null, bindTypes = null;
		if fetch bindParams, parameters["bind"] {
			fetch bindTypes, parameters["bindTypes"];
		}

		/**
		 * Pass the cache options to the query
		 */
		if fetch cache, parameters["cache"] {
			query->cache(cache);
		}

		/**
		 * Execute the query
		 */
		let resultset = query->execute(bindParams, bindTypes);

		/**
		 * Return the full resultset if the query is grouped
		 */
		if isset parameters["group"] {
			return resultset;
		}

		/**
		 * Return only the value in the first result
		 */
		let firstRow = resultset->getFirst();
		return firstRow->{alias};
	}

	/**
	 * Create a criteria for a specific model
	 */
	public function query(<DiInterface> dependencyInjector = null) -> <CriteriaInterface>
	{
		var criteria;

		/**
		 * Use the global dependency injector if there is no one defined
		 */
		if typeof dependencyInjector != "object" {
			let dependencyInjector = Di::getDefault();
		}

		/**
		 * Gets Criteria instance from DI container
		 */
		if dependencyInjector instanceof DiInterface {
			let criteria = <CriteriaInterface> dependencyInjector->get("Phalcon\\Mvc\\Model\\Criteria");
		} else {
			let criteria = new Criteria();
			criteria->setDI(dependencyInjector);
		}

		criteria->setModelName(this->_modelClass);

		return criteria;
	}

	/**
	 * Handles method calls when a method is not implemented
	 */
	public function __call(string method, array arguments)
	{
		var records;

		let records = this->_invokeFinder(method, arguments);
		if records === null {
			throw new Exception("The method '" . method . "' doesn't exist");
		}

		return records;
	}

	/**
	 * Try to check if the query must invoke a finder
	 *
	 * @return \Phalcon\Mvc\ModelInterface[]|\Phalcon\Mvc\ModelInterface|boolean
	 */
	protected final function _invokeFinder(string method, array arguments)
	{
		var extraMethod, type, modelName, value, model,
			attributes, field, extraMethodFirst, metaData;

		let extraMethod = null;

		/**
		 * Check if the method starts with "findFirst"
		 */
		if starts_with(method, "findFirstBy") {
			let type = "findFirst",
				extraMethod = substr(method, 11);
		}

		/**
		 * Check if the method starts with "find"
		 */
		elseif starts_with(method, "findBy") {
			let type = "find",
				extraMethod = substr(method, 6);
		}

		/**
		 * Check if the method starts with "count"
		 */
		elseif starts_with(method, "countBy") {
			let type = "count",
				extraMethod = substr(method, 7);
		}

		let modelName = this->_modelClass;

		if !extraMethod {
			return null;
		}

		if !fetch value, arguments[0] {
			throw new Exception("The method '" . method . "' requires one argument");
		}

		let model = new {modelName}(),
			metaData = model->getModelsMetaData();

		/**
		 * Get the attributes
		 */
		let attributes = metaData->getReverseColumnMap(model);
		if typeof attributes != "array" {
			let attributes = metaData->getDataTypes(model);
		}

		/**
		 * Check if the extra-method is an attribute
		 */
		if isset attributes[extraMethod] {
			let field = extraMethod;
		} else {

			/**
			 * Lowercase the first letter of the extra-method
			 */
			let extraMethodFirst = lcfirst(extraMethod);
			if isset attributes[extraMethodFirst] {
				let field = extraMethodFirst;
			} else {

				/**
				 * Get the possible real method name
				 */
				let field = uncamelize(extraMethod);
				if !isset attributes[field] {
					throw new Exception("Cannot resolve attribute '" . extraMethod . "' in the model");
				}
			}
		}

		/**
		 * Execute the query
		 */
		return this->{type}(
			[
				"conditions": "[" . field . "] = ?0",
				"bind":       [value]
			]
		);
	}
}
