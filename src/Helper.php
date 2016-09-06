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

defined( 'GEARSPATH' ) || exit( 'No direct script access allowed' );

// ------------------------------------------------------------------------

/**
 * Gears Helper
 *
 * Collections shortcut functions for Gears Output classes and other functions that
 * simplify the developers to perform debugging.
 * 
 * @see http://o2system.io/user-guide/developers/gears.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_out' ) )
{
	/**
	 * Print Out
	 *
	 * Equipping developers to issue any kind of variable output to the browser.
	 *
	 * @param mixed $vars
	 * @param bool  $halt
	 */
	function print_out( $vars, $halt = TRUE )
	{
		O2System\Gears\Output::printScreen( $vars, $halt );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_line' ) )
{
	/**
	 * Print Line
	 *
	 * Equipping developers to issue any kind of variable output to the browser,
	 * can be placed in various places in the source code program.
	 *
	 * @param string $line
	 * @param bool   $halt
	 */
	function print_line( $line = '', $halt = FALSE )
	{
		O2System\Gears\Output::printLine( $line, $halt );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_code' ) )
{
	/**
	 * Print Code
	 *
	 * Make it easier for developers to issue any kind of variable output to the browser
	 * inside pre tag.
	 *
	 * @param mixed $vars
	 * @param bool  $halt
	 */
	function print_code( $vars, $halt = FALSE )
	{
		O2System\Gears\Output::printCode( $vars, $halt );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_dump' ) )
{
	/**
	 * Print Dump
	 *
	 * Make it easier for developers to dump any kind of variable output to the browser
	 * inside pre tag.
	 *
	 * @param mixed $vars
	 * @param bool  $halt
	 */
	function print_dump( $vars, $halt = TRUE )
	{
		O2System\Gears\Output::printDump( $vars, $halt );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_json' ) )
{
	/**
	 * Print JSON
	 *
	 * Make it easier for developers to output object or array variable type
	 * to the browser in JSON format.
	 *
	 * @see http://php.net/manual/en/json.constants.php
	 *
	 * @param mixed    $vars
	 * @param null|int $option JSON Constants Options
	 * @param bool     $halt
	 */
	function print_json( $vars, $option = NULL, $halt = TRUE )
	{
		O2System\Gears\Output::printJSON( $vars, $option, $halt );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_console' ) )
{
	/**
	 * Print Console
	 *
	 * Equipping developers to issue any kind of variable output to the browser console,
	 * can be placed in various places in the source code program.
	 *
	 * @param string $title
	 * @param array  $vars
	 * @param int    $type
	 */
	function print_console( $title, $vars = [ ], $type = \O2System\Gears\Console::LOG )
	{
		O2System\Gears\Output::printConsole( $title, $vars, $type );
	}
}

if ( ! function_exists( 'pre_open' ) )
{
	/**
	 * Pre Open
	 *
	 * Echo a <pre> tag open HTML element.
	 */
	function pre_open()
	{
		echo '<pre>';
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'pre_line' ) )
{
	/**
	 * Pre Line
	 *
	 * Echo a pre line content.
	 *
	 * @param mixed $line
	 * @param bool  $implode
	 */
	function pre_line( $line, $implode = TRUE )
	{
		if ( is_array( $line ) AND $implode === TRUE )
		{
			$line = implode( PHP_EOL, $line );
		}
		elseif ( is_bool( $line ) )
		{
			if ( $line === TRUE )
			{
				$line = '(bool) TRUE';
			}
			else
			{
				$line = '(bool) FALSE';
			}
		}
		elseif ( is_resource( $line ) )
		{
			$line = '(resource) ' . get_resource_type( $line );
		}
		elseif ( is_array( $line ) || is_object( $line ) )
		{
			$line = @print_r( $line, TRUE );
		}
		elseif ( is_int( $line ) OR is_numeric( $line ) )
		{
			$line = '(int) ' . $line;
		}
		elseif ( is_null( $line ) )
		{
			$line = '(null)';
		}

		echo $line . PHP_EOL;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'pre_close' ) )
{
	/**
	 * Pre Close
	 *
	 * Echo a </pre> tag close HTML element.
	 *
	 * @param bool $halt
	 */
	function pre_close( $halt = FALSE )
	{
		echo '</pre>';

		if ( $halt )
		{
			die;
		}
	}
}