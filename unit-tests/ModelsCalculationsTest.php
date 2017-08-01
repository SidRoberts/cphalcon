<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
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

class ModelsCalculationsTest extends PHPUnit_Framework_TestCase
{

	public function __construct()
	{
		spl_autoload_register(array($this, 'modelsAutoloader'));
	}

	public function __destruct()
	{
		spl_autoload_unregister(array($this, 'modelsAutoloader'));
	}

	public function modelsAutoloader($className)
	{
		if (file_exists('unit-tests/models/'.$className.'.php')) {
			require 'unit-tests/models/'.$className.'.php';
		}
	}

	protected function _getDI()
	{

		Phalcon\DI::reset();

		$di = new Phalcon\DI();

		$di->set('modelsManager', function(){
			return new Phalcon\Mvc\Model\Manager();
		});

		$di->set('modelsMetadata', function(){
			return new Phalcon\Mvc\Model\Metadata\Memory();
		});

		return $di;
	}

	/**
	 * @medium
	 */
	public function testCalculationsMysql()
	{
		require 'unit-tests/config.db.php';
		if (empty($configMysql)) {
			$this->markTestSkipped("Skipped");
			return;
		}

		$di = $this->_getDI();

		$di->set('db', function(){
			require 'unit-tests/config.db.php';
			return new Phalcon\Db\Adapter\Pdo\Mysql($configMysql);
		}, true);

		$this->_executeTestsNormal($di);
		$this->_executeTestsRenamed($di);

	}

	/**
	 * @medium
	 */
	public function testCalculationsPostgresql()
	{
		require 'unit-tests/config.db.php';
		if (empty($configPostgresql)) {
			$this->markTestSkipped("Skipped");
			return;
		}

		$di = $this->_getDI();

		$di->set('db', function(){
			require 'unit-tests/config.db.php';
			return new Phalcon\Db\Adapter\Pdo\Postgresql($configPostgresql);
		}, true);

		$this->_executeTestsNormal($di);
		$this->_executeTestsRenamed($di);

	}

	/**
	 * @medium
	 */
	public function testCalculationsSqlite()
	{
		require 'unit-tests/config.db.php';
		if (empty($configSqlite)) {
			$this->markTestSkipped("Skipped");
			return;
		}

		$di = $this->_getDI();

		$di->set('db', function(){
			require 'unit-tests/config.db.php';
			return new Phalcon\Db\Adapter\Pdo\Sqlite($configSqlite);
		}, true);

		$this->_executeTestsNormal($di);
		$this->_executeTestsRenamed($di);
	}

	protected function _executeTestsNormal($di)
	{
		$personnesRepository = $di->get("modelsManager")->getRepository(
			Personnes::class
		);



		//Count calculations
		$rowcount = $personnesRepository->count();
		$this->assertEquals($rowcount, 2180);

		$rowcount = $personnesRepository->count(
			array('distinct' => 'estado')
		);
		$this->assertEquals($rowcount, 2);

		$rowcount = $personnesRepository->count(
			["estado='A'"]
		);
		$this->assertEquals($rowcount, 2178);

		$group = $personnesRepository->count(
			array("group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$group = $personnesRepository->count(
			array("group" => "estado", "order" => "estado")
		);
		$this->assertEquals(2, count($group));

		$results = array('A' => 2178, 'I' => 2);
		foreach($group as $row){
			$this->assertEquals($results[$row->estado], $row->rowcount);
		}

		$this->assertEquals($group[0]->rowcount, 2178);
		$this->assertEquals($group[1]->rowcount, 2);

		$group = $personnesRepository->count(
			array("group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$group = $personnesRepository->count(
			array("group" => "ciudad_id")
		);
		$this->assertEquals(285, count($group));

		$group = $personnesRepository->count(
			array("group" => "ciudad_id", "order" => "rowcount DESC")
		);
		$this->assertEquals($group[0]->rowcount, 727);

		//Summatory
		$total = $personnesRepository->sum(
			array("column" => "cupo")
		);
		$this->assertEquals(995066020.00, $total);

		$total = $personnesRepository->sum(
			array("column" => "cupo", "conditions" => "estado='I'")
		);
		$this->assertEquals(567020.00, $total);

		$group = $personnesRepository->sum(
			array("column" => "cupo", "group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$results = array('A' => 994499000.00, 'I' => 567020.00);
		foreach($group as $row){
			$this->assertEquals($results[$row->estado], $row->sumatory);
		}

		$group = $personnesRepository->sum(
			array("column" => "cupo", "group" => "ciudad_id", "order" => "sumatory DESC")
		);
		$this->assertEquals($group[0]->sumatory, 358467690.00);

		//Average
		$total = $personnesRepository->average(
			array("column" => "cupo")
		);
		$this->assertEquals(456452.30, sprintf("%.2f", $total));

		$total = $personnesRepository->average(
			array("column" => "cupo", "conditions" => "estado='I'")
		);
		$this->assertEquals(283510.00, $total);

		$group = $personnesRepository->average(
			array("column" => "cupo", "group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$results = array('A' => 456611.11, 'I' => 283510.00);
		foreach($group as $row){
			$this->assertEquals($results[$row->estado], sprintf("%.2f", $row->average));
		}

		$group = $personnesRepository->average(
			array("column" => "cupo", "group" => "ciudad_id", "order" => "average DESC")
		);
		$this->assertEquals($group[0]->average, 996200.00);

		//Maximum
		$max = $personnesRepository->maximum(
			array("column" => "ciudad_id")
		);
		$this->assertEquals($max, 302172);

		$max = $personnesRepository->maximum(
			array("column" => "ciudad_id", "conditions" => "estado='I'")
		);
		$this->assertEquals($max, 127591);

		$group = $personnesRepository->maximum(
			array("column" => "ciudad_id", "group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$results = array('A' => 302172, 'I' => 127591);
		foreach($group as $row){
			$this->assertEquals($results[$row->estado], $row->maximum);
		}

		$group = $personnesRepository->maximum(
			array("column" => "ciudad_id", "group" => "estado", "order" => "maximum DESC")
		);
		$this->assertEquals($group[0]->maximum, 302172);

		//Minimum
		$max = $personnesRepository->minimum(
			array("column" => "ciudad_id")
		);
		$this->assertEquals($max, 20404);

		$max = $personnesRepository->minimum(
			array("column" => "ciudad_id", "conditions" => "estado='I'")
		);
		$this->assertEquals($max, 127591);

		$group = $personnesRepository->minimum(
			array("column" => "ciudad_id", "group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$results = array('A' => 20404, 'I' => 127591);
		foreach($group as $row){
			$this->assertEquals($results[$row->estado], $row->minimum);
		}

		$group = $personnesRepository->minimum(
			array("column" => "ciudad_id", "group" => "estado", "order" => "minimum DESC")
		);
		$this->assertEquals($group[0]->minimum, 127591);

		$group = $personnesRepository->minimum(
			array("column" => "ciudad_id", "group" => "estado", "order" => "minimum ASC")
		);
		$this->assertEquals($group[0]->minimum, 20404);

	}

	protected function _executeTestsRenamed($di)
	{
		$pessoasRepository = $di->get("modelsManager")->getRepository(
			Pessoas::class
		);

		//Count calculations
		$rowcount = $pessoasRepository->count();
		$this->assertEquals($rowcount, 2180);

		$rowcount = $pessoasRepository->count(
			array('distinct' => 'estado')
		);
		$this->assertEquals($rowcount, 2);

		$rowcount = $pessoasRepository->count(
			["estado='A'"]
		);
		$this->assertEquals($rowcount, 2178);

		$group = $pessoasRepository->count(
			array("group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$group = $pessoasRepository->count(
			array("group" => "estado", "order" => "estado")
		);
		$this->assertEquals(2, count($group));

		$results = array('A' => 2178, 'I' => 2);
		foreach($group as $row){
			$this->assertEquals($results[$row->estado], $row->rowcount);
		}

		$this->assertEquals($group[0]->rowcount, 2178);
		$this->assertEquals($group[1]->rowcount, 2);

		$group = $pessoasRepository->count(
			array("group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$group = $pessoasRepository->count(
			array("group" => "cidadeId")
		);
		$this->assertEquals(285, count($group));

		$group = $pessoasRepository->count(
			array("group" => "cidadeId", "order" => "rowcount DESC")
		);
		$this->assertEquals($group[0]->rowcount, 727);

		//Summatory
		$total = $pessoasRepository->sum(
			array("column" => "credito")
		);
		$this->assertEquals(995066020.00, $total);

		$total = $pessoasRepository->sum(
			array("column" => "credito", "conditions" => "estado='I'")
		);
		$this->assertEquals(567020.00, $total);

		$group = $pessoasRepository->sum(
			array("column" => "credito", "group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$results = array('A' => 994499000.00, 'I' => 567020.00);
		foreach($group as $row){
			$this->assertEquals($results[$row->estado], $row->sumatory);
		}

		$group = $pessoasRepository->sum(
			array("column" => "credito", "group" => "cidadeId", "order" => "sumatory DESC")
		);
		$this->assertEquals($group[0]->sumatory, 358467690.00);

		//Average
		$total = $pessoasRepository->average(
			array("column" => "credito")
		);
		$this->assertEquals(456452.30, sprintf("%.2f", $total));

		$total = $pessoasRepository->average(
			array("column" => "credito", "conditions" => "estado='I'")
		);
		$this->assertEquals(283510.00, $total);

		$group = $pessoasRepository->average(
			array("column" => "credito", "group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$results = array('A' => 456611.11, 'I' => 283510.00);
		foreach($group as $row){
			$this->assertEquals($results[$row->estado], sprintf("%.2f", $row->average));
		}

		$group = $pessoasRepository->average(
			array("column" => "credito", "group" => "cidadeId", "order" => "average DESC")
		);
		$this->assertEquals($group[0]->average, 996200.00);

		//Maximum
		$max = $pessoasRepository->maximum(
			array("column" => "cidadeId")
		);
		$this->assertEquals($max, 302172);

		$max = $pessoasRepository->maximum(
			array("column" => "cidadeId", "conditions" => "estado='I'")
		);
		$this->assertEquals($max, 127591);

		$group = $pessoasRepository->maximum(
			array("column" => "cidadeId", "group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$results = array('A' => 302172, 'I' => 127591);
		foreach($group as $row){
			$this->assertEquals($results[$row->estado], $row->maximum);
		}

		$group = $pessoasRepository->maximum(
			array("column" => "cidadeId", "group" => "estado", "order" => "maximum DESC")
		);
		$this->assertEquals($group[0]->maximum, 302172);

		//Minimum
		$max = $pessoasRepository->minimum(
			array("column" => "cidadeId")
		);
		$this->assertEquals($max, 20404);

		$max = $pessoasRepository->minimum(
			array("column" => "cidadeId", "conditions" => "estado='I'")
		);
		$this->assertEquals($max, 127591);

		$group = $pessoasRepository->minimum(
			array("column" => "cidadeId", "group" => "estado")
		);
		$this->assertEquals(2, count($group));

		$results = array('A' => 20404, 'I' => 127591);
		foreach($group as $row){
			$this->assertEquals($results[$row->estado], $row->minimum);
		}

		$group = $pessoasRepository->minimum(
			array("column" => "cidadeId", "group" => "estado", "order" => "minimum DESC")
		);
		$this->assertEquals($group[0]->minimum, 127591);

		$group = $pessoasRepository->minimum(
			array("column" => "cidadeId", "group" => "estado", "order" => "minimum ASC")
		);
		$this->assertEquals($group[0]->minimum, 20404);

	}


}