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
defined( 'GEARSPATH' ) || exit( 'No direct script access allowed' );

// ------------------------------------------------------------------------

/**
 * O2System Gears Output
 *
 * @package O2System\Gears
 */
class Output
{
	protected static $lines = [ ];

	public static function assetURL()
	{
		// Add base path
		$assetURL = str_replace( [ dirname( $_SERVER[ 'SCRIPT_FILENAME' ] ) . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR ], [ '', '/' ], GEARSPATH );
		$assetURL = str_replace( DIRECTORY_SEPARATOR, '/', $assetURL );
		$assetURL = trim( $assetURL, '/' ) . '/Views/assets/';

		return $assetURL;
	}

	/**
	 * Print Out
	 *
	 * Equipping developers to issue any kind of variable output to the browser.
	 *
	 * @param mixed $vars string|array|object|integer|boolean
	 * @param bool  $halt set FALSE to disabled halt output
	 */
	public static function printScreen( $vars, $halt = TRUE )
	{
		ini_set( 'memory_limit', '512M' );

		$vars = static::prepareOutput( $vars );
		$vars = htmlentities( $vars );
		$vars = htmlspecialchars( htmlspecialchars_decode( $vars, ENT_QUOTES ), ENT_QUOTES, 'UTF-8' );
		$trace = new Trace();
		$assetsURL = static::assetURL();

		ob_start();
		include GEARSPATH . 'Views/Screen.php';
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;

		if ( $halt === TRUE )
		{
			die;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Print Code
	 *
	 * Make it easier for developers to issue any kind of variable output to the browser
	 * inside pre tag.
	 *
	 * @param mixed $vars string|array|object|integer|boolean
	 * @param mixed $halt set FALSE to disabled halt output
	 */
	public static function printCode( $vars, $halt = TRUE )
	{
		ini_set( 'memory_limit', '512M' );

		$vars = static::prepareOutput( $vars );
		$vars = htmlentities( $vars );
		$vars = htmlspecialchars( htmlspecialchars_decode( $vars, ENT_QUOTES ), ENT_QUOTES, 'UTF-8' );

		echo '<pre>' . $vars . '</pre>';

		if ( $halt === TRUE )
		{
			die;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Print JSON
	 *
	 * Make it easier for developers to output object or array variable type
	 * to the browser in JSON format.
	 *
	 * @param mixed $vars   string|array|object|integer|boolean
	 * @param mixed $option bool|integer JSON Encode Option
	 * @param mixed $halt   bool set FALSE to disabled halt output
	 */
	public static function printJSON( $vars, $option = NULL, $halt = TRUE )
	{
		if ( is_bool( $option ) )
		{
			$halt   = $option;
			$option = NULL;
		}

		if ( is_numeric( $option ) )
		{
			static::printScreen( json_encode( $vars, $option ), $halt );
		}
		else
		{
			static::printScreen( json_encode( $vars ), $halt );
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Print Line
	 *
	 * Equipping developers to issue any kind of variable output to the browser,
	 * can be placed in various places in the source code program.
	 *
	 * @param mixed $line  string|array|object|integer|boolean
	 * @param mixed $halt  set TRUE to halt output
	 *                     set (string) FLUSH to flush previous sets of lines output
	 */
	public static function printLine( $line = '', $halt = FALSE )
	{
		if ( strtoupper( $halt ) === 'FLUSH' )
		{
			static::$lines   = [ ];
			static::$lines[] = $line;
		}

		if ( is_array( $line ) || is_object( $line ) )
		{
			static::$lines[] = print_r( $line, TRUE );
		}
		else
		{
			static::$lines[] = static::prepareOutput( $line );
		}

		if ( $halt === TRUE OR $line === '---' )
		{
			$vars          = implode( PHP_EOL, static::$lines );
			static::$lines = [ ];
			static::printScreen( $vars, $halt );
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Print Dump
	 *
	 * Make it easier for developers to dump any kind of variable output to the browser
	 * inside pre tag.
	 *
	 * @param mixed $vars string|array|object|integer|boolean
	 * @param mixed $halt set FALSE to disabled halt output
	 */
	public static function printDump( $vars, $halt = TRUE )
	{
		ob_start();
		var_dump( $vars );
		$output = ob_get_contents();
		ob_end_clean();

		static::printCode( $output, $halt );
	}

	// ------------------------------------------------------------------------

	/**
	 * Print Console
	 *
	 * Equipping developers to issue any kind of variable output to the browser console,
	 * can be placed in various places in the source code program.
	 *
	 * @param string $label
	 * @param array  $vars
	 * @param int    $type
	 */
	public static function printConsole( $label, $vars, $type = Console::LOG )
	{
		Console::sendOutput( $type, $label, $vars );
	}

	// ------------------------------------------------------------------------

	/**
	 * Prepare Output
	 *
	 * Prepare output variables.
	 *
	 * @param $vars
	 *
	 * @return mixed|string
	 */
	public static function prepareOutput( $vars )
	{
		if ( is_bool( $vars ) )
		{
			if ( $vars === TRUE )
			{
				$vars = '(bool) TRUE';
			}
			else
			{
				$vars = '(bool) FALSE';
			}
		}
		elseif ( is_resource( $vars ) )
		{
			$vars = '(resource) ' . get_resource_type( $vars );
		}
		elseif ( is_array( $vars ) || is_object( $vars ) )
		{
			$vars = @print_r( $vars, TRUE );
		}
		elseif ( is_int( $vars ) OR is_numeric( $vars ) )
		{
			$vars = '(int) ' . $vars;
		}
		elseif ( is_null( $vars ) )
		{
			$vars = '(null)';
		}

		return $vars;
	}
}