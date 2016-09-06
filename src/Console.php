<?php
/**
 * O2System
 *
 * An open source application development framework for PHP 5.4.0 or newer
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014, O2System Framework Developer Team
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package        O2System\Core
 * @author         O2System Framework Developer Team
 * @copyright      Copyright (c) 2005 - 2014, O2System PHP Framework
 * @license        http://www.o2system.io/license.html
 * @license        http://opensource.org/licenses/MIT	MIT License
 * @link           http://www.o2system.io
 * @since          Version 2.0
 * @filesource
 */
// ------------------------------------------------------------------------

namespace O2System\Gears;

use PhpConsole\Handler;

defined( 'GEARSPATH' ) || exit( 'No direct script access allowed' );

// ------------------------------------------------------------------------

/**
 * O2System Gears Console
 *
 * @package O2System\Gears
 */
class Console
{
	/**
	 * Console Log
	 *
	 * @var int
	 */
	const LOG = 1;

	/**
	 * Console Info
	 *
	 * @var int
	 */
	const INFO = 2;

	/**
	 * Console Warnine
	 *
	 * @var int
	 */
	const WARNING = 3;

	/**
	 * Console Error
	 *
	 * @var int
	 */
	const ERROR = 4;

	// ------------------------------------------------------------------------

	/**
	 * Log
	 *
	 * Send output to browser log console
	 *
	 * @access  public
	 * @static  static class method
	 *
	 * @param   string $label string of output title
	 * @param   mixed  $vars  mixed type variables of data
	 */
	public static function log( $label, $vars )
	{
		static::sendOutput( static::LOG, $label, $vars );
	}
	// ------------------------------------------------------------------------

	/**
	 * Send Output
	 *
	 * Send output to browser debug console
	 *
	 * @access  public
	 * @static  static class method
	 *
	 * @param   int    $type  console type
	 * @param   string $label string of output title
	 * @param   mixed  $vars  mixed type variables of data
	 */
	public static function sendOutput( $type, $label, $vars )
	{
		$phpConsoleHandler = Handler::getInstance();
		$phpConsoleHandler->start(); // start handling PHP errors & exceptions

		$sourceBasePath = defined( 'ROOTPATH' ) ? ROOTPATH : dirname( $_SERVER[ 'SCRIPT_FILENAME' ] );

		$phpConsoleHandler->getConnector()->setSourcesBasePath( $sourceBasePath );

		echo '<script type="text/javascript">' . PHP_EOL;
		switch ( $type )
		{
			default:
			case 1:
				$phpConsoleHandler->debug( $vars, $label );
				echo "console.debug('%c $label ', 'background: #777; color: #fff');" . PHP_EOL;
				break;
			case 2:
				echo "console.info('%c $label ', 'background: #5bc0de; color: #fff');" . PHP_EOL;
				break;
			case 3:
				echo "console.warn('%c $label ', 'background: #f0ad4e; color: #fff');" . PHP_EOL;
				break;
			case 4:
				echo "console.error('%c $label ', 'background: #d9534f; color: #fff');" . PHP_EOL;
				break;
		}

		if ( ! empty( $vars ) )
		{
			$vars = is_object( $vars ) || is_array( $vars ) ? 'JSON.parse(\'' . json_encode( $vars ) . '\')' : '\'' . $vars . '\'';

			switch ( $type )
			{
				default:
				case 1:
					echo "console.debug($vars);" . PHP_EOL;
					break;
				case 2:
					echo "console.info($vars);" . PHP_EOL;
					break;
				case 3:
					echo "console.warn($vars);" . PHP_EOL;
					break;
				case 4:
					echo "console.error($vars);" . PHP_EOL;
					break;
			}
		}
		echo '</script>' . PHP_EOL;
	}

	// ------------------------------------------------------------------------

	/**
	 * Info
	 *
	 * Send output to browser info console
	 *
	 * @access  public
	 * @static  static class method
	 *
	 * @param   string $label string of output title
	 * @param   mixed  $vars  mixed type variables of data
	 */
	public static function info( $label, $vars )
	{
		static::sendOutput( static::INFO, $label, $vars );
	}

	// ------------------------------------------------------------------------

	/**
	 * Warning
	 *
	 * Send output to browser warning console
	 *
	 * @access  public
	 * @static  static class method
	 *
	 * @param   string $label string of output title
	 * @param   mixed  $vars  mixed type variables of data
	 */
	public static function warning( $label, $vars )
	{
		static::sendOutput( static::WARNING, $label, $vars );
	}
	// ------------------------------------------------------------------------

	/**
	 * Error
	 *
	 * Send output to browser error console
	 *
	 * @access  public
	 * @static  static class method
	 *
	 * @param   string $label string of output title
	 * @param   mixed  $vars  mixed type variables of data
	 */
	public static function error( $label, $vars )
	{
		static::sendOutput( static::ERROR, $label, $vars );
	}
}