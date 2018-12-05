
/*
 +------------------------------------------------------------------------+
 | Phalcon Framework                                                      |
 +------------------------------------------------------------------------+
 | Copyright (c) 2011-2017 Phalcon Team (https://phalconphp.com)          |
 +------------------------------------------------------------------------+
 | This source file is subject to the New BSD License that is bundled     |
 | with this package in the file LICENSE.txt.                             |
 |                                                                        |
 | If you did not receive a copy of the license and are unable to         |
 | obtain it through the world-wide-web, please send an email             |
 | to license@phalconphp.com so we can send you a copy immediately.       |
 +------------------------------------------------------------------------+
 | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
 |          Eduar Carvajal <eduar@phalconphp.com>                         |
 +------------------------------------------------------------------------+
 */

namespace Phalcon;

/**
 * Phalcon\FlashInterface
 *
 * Interface for Phalcon\Flash
 */
interface FlashInterface
{

	/**
	 * Shows a HTML error message
	 */
	public function error(string message);

	/**
	 * Outputs a message
	 */
	public function message(string type, string message);

	/**
	 * Shows a HTML notice/information message
	 */
	public function notice(string message);

	/**
	 * Shows a HTML success message
	 */
	public function success(string message);

	/**
	 * Shows a HTML warning message
	 */
	public function warning(string message);
}
