<?php

namespace Phalcon\Test\Models;

use Phalcon\Mvc\Model;

/**
 * Robos
 *
 * "Robôs" is robots in portuguese
 * 
 * @author David Napierata
 *
 * @package Phalcon\Test\Models
 */
class Robos extends Model
{
    public function initialize()
    {
        $this->setSource("robots");

        $this->setConnectionService('dbTwo');
    }
}
