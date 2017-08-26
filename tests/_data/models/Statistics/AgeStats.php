<?php

namespace Phalcon\Test\Models\Statistics;

use Phalcon\Mvc\Model;
use Phalcon\Test\ModelRepositories\Statistics\AgeStatsRepository;

/**
 * \Phalcon\Test\Models\Statistics\AgeStats
 *
 * @copyright (c) 2011-2017 Phalcon Team
 * @link      http://www.phalconphp.com
 * @author    Eugene Smirnov <ashpumpkin@gmail.com>
 * @package   Phalcon\Test\Models\Statistics
 *
 * The contents of this file are subject to the New BSD License that is
 * bundled with this package in the file LICENSE.txt
 *
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email to license@phalconphp.com
 * so that we can send you a copy immediately.
 */
class AgeStats extends Model
{
	public static function getRepositoryClass()
	{
		return AgeStatsRepository::class;
	}

	public function getResultsetClass()
	{
		return 'Phalcon\Test\Resultsets\Stats';
	}
}
