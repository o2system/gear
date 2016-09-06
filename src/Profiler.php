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
 * O2System Gears Profiler
 *
 * @package O2System\Gears
 */
class Profiler
{
	public static $startTime;
	public static $startMemory;

	protected static $backtrace = [ ];

	public function __construct()
	{
		declare( ticks = 1 );
		register_tick_function( [ &$this, 'benchmark' ] );

		static::$startTime   = microtime( TRUE );
		static::$startMemory = memory_get_usage( TRUE );
	}

	public function setStartTime( $startTime )
	{
		static::$startTime = $startTime;
	}

	public function setStartMemory( $startMemory )
	{
		static::$startMemory = $startMemory;
	}

	public function getStartTime()
	{
		return static::$startTime;
	}

	public function getStartMemory()
	{
		return static::$startMemory;
	}

	public function benchmark()
	{
		$backtrace = debug_backtrace();

		if ( count( $backtrace ) <= 1 )
		{
			return;
		}

		foreach ( $backtrace as $key => $trace )
		{
			if ( isset( $trace[ 'class' ] ) AND $trace[ 'class' ] === 'O2System\Gears\Profiler' )
			{
				unset( $backtrace[ $key ] );
				continue;
			}
			else
			{
				$marker = empty( $trace[ 'class' ] ) ? $trace[ 'function' ] : $trace[ 'class' ] . '::' . $trace[ 'function' ];

				if ( ! in_array( $marker, [ 'include', 'include_once', 'require', 'require_once' ] ) )
				{
					self::$backtrace[ $marker . '()' ] = [
						'time'   => ( microtime( TRUE ) - static::$startTime ),
						'memory' => round( ( memory_get_usage( TRUE ) - static::$startMemory ) / 1024 / 1024, 4 ) . ' MB',
					];

					self::$backtrace[ $marker . '()' ] = array_merge( $trace, self::$backtrace[ $marker . '()' ] );
				}

				static::$startTime = microtime( TRUE );

				break;
			}
		}
	}

	public function getBacktrace()
	{
		return self::$backtrace;
	}

	public function getOutput()
	{
		$backtrace = self::$backtrace;

		ob_start();
		include GEARSPATH . 'Views/Profiler.php';
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}
}