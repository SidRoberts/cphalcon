<?php

namespace Some;

/**
 * Deles
 *
 * Deles is "parts" in danish
 */
class Deles extends \Phalcon\Mvc\Model
{

	public function columnMap()
	{
		return array(
			'id' => 'code',
			'name' => 'theName',
		);
	}

	public function initialize()
	{
		$this->setSource('parts');

		$this->hasMany('code', 'Some\RobottersDeles', 'delesCode', array(
			'foreignKey' => array(
				'message' => 'Deles cannot be deleted because is referenced by a Robotter'
			)
		));
	}

}
