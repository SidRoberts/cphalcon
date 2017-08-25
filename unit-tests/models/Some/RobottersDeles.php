<?php

namespace Some;

/**
 * RobottersDeles
 *
 * This model is an intermediate table for "Robotters" and "Deles"
 */
class RobottersDeles extends \Phalcon\Mvc\Model
{
	public function columnMap()
	{
		return array(
			'id' => 'code',
			'robots_id' => 'robottersCode',
			'parts_id' => 'delesCode',
		);
	}

	public function initialize()
	{
		$this->setSource('robots_parts');

		$this->belongsTo('delesCode', Deles::class, 'code', array(
			'foreignKey' => true
		));

		$this->belongsTo('robottersCode', Robotters::class, 'code', array(
			'foreignKey' => array(
				'message' => 'The robotters code does not exist'
			)
		));
	}

}
