<?php

namespace Some;

class Parts extends \Phalcon\Mvc\Model
{
	public function initialize()
	{
		$this->setSource('parts');

		$this->hasMany('id', 'RobotsParts', 'parts_id', array(
			'foreignKey' => array(
				'message' => 'Parts cannot be deleted because is referenced by a Robot'
			)
		));
	}

}
