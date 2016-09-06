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
 * O2System Gears Debug
 *
 * @package O2System\Gears
 */
class Debug
{
	/**
	 * List of Debug Chronology
	 *
	 * @access  private
	 * @static
	 *
	 * @type    array
	 */
	private static $chronology = [ ];

	// ------------------------------------------------------------------------

	/**
	 * Start
	 *
	 * Start Debug Process
	 *
	 * @access  public
	 * @static  static method
	 */
	public static function start()
	{
		static::$chronology = [ ];
		static::$chronology[] = static::__whereCall( __CLASS__ . '::start()' );
	}

	// ------------------------------------------------------------------------

	/**
	 * Where Call Method
	 *
	 * Finding where the call is made
	 *
	 * @access          private
	 *
	 * @param   $call   String Call Method
	 *
	 * @return          Trace Object
	 */
	private static function __whereCall( $call )
	{
		$tracer = new Trace();

		foreach ( $tracer->chronology() as $trace )
		{
			if ( $trace->call === $call )
			{
				return $trace;
				break;
			}
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Line
	 *
	 * Add debug line output
	 *
	 * @param mixed $vars
	 * @param bool  $export
	 */
	public static function line( $vars, $export = FALSE )
	{
		$trace = static::__whereCall( __CLASS__ . '::line()' );

		if ( $export === TRUE )
		{
			$trace->data = var_export( $vars, TRUE );
		}
		else
		{
			$trace->data = Output::prepareOutput( $vars );
		}

		static::$chronology[] = $trace;
	}

	// ------------------------------------------------------------------------

	/**
	 * Marker
	 *
	 * Set Debug Marker
	 */
	public static function marker()
	{
		$trace = static::__whereCall( __CLASS__ . '::marker()' );
		static::$chronology[] = $trace;
	}

	// ------------------------------------------------------------------------

	/**
	 * Stop Debug
	 *
	 * @param bool $halt
	 */
	public static function stop( $halt = TRUE )
	{
		static::$chronology[] = static::__whereCall( __CLASS__ . '::stop()' );
		$chronology = static::$chronology;
		static::$chronology = [ ];

		Output::printScreen( $chronology, $halt );
	}
}