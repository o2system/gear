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
 * O2System Gears Trace
 *
 * @package O2System\Gears
 */
class Trace
{
	/**
	 * Class Name
	 *
	 * @access  protected
	 * @type    string name of called class
	 */
	const PROVIDE_OBJECT = DEBUG_BACKTRACE_PROVIDE_OBJECT;

	/**
	 * Class Name
	 *
	 * @access  protected
	 * @type    string name of called class
	 */
	const IGNORE_ARGS = DEBUG_BACKTRACE_IGNORE_ARGS;

	/**
	 * Class Name
	 *
	 * @access  protected
	 * @type    string name of called class
	 */
	private $trace = NULL;
	/**
	 * Class Name
	 *
	 * @access  protected
	 * @type    string name of called class
	 */
	private $chronology = [ ];
	/**
	 * Class Name
	 *
	 * @access  protected
	 * @type    string name of called class
	 */
	private $benchmark = [ ];

	// ------------------------------------------------------------------------

	/**
	 * Class Constructor
	 *
	 * @access public
	 *
	 * @param string $flag tracer option
	 */
	public function __construct( $trace = [ ], $flag = Trace::PROVIDE_OBJECT )
	{
		$this->benchmark = [
			'time'   => Profiler::$startTime,
			'memory' => Profiler::$startMemory,
		];

		if ( ! empty( $trace ) )
		{
			$this->trace = $trace;
		}
		else
		{
			$this->trace = debug_backtrace( $flag );
		}

		// reverse array to make steps line up chronologically
		$this->trace = array_reverse( $this->trace );

		// Generate Lines
		$this->__generateChronology();
	}

	// ------------------------------------------------------------------------

	/**
	 * Generate Chronology Method
	 *
	 * Generate array of Backtrace Chronology
	 *
	 * @access           private
	 * @return           void
	 */
	private function __generateChronology()
	{
		foreach ( $this->trace as $trace )
		{
			if ( in_array( $trace[ 'function' ], [ 'showException', 'showError', 'showPhpError', 'shutdown' ] ) OR
				( isset( $trace[ 'class' ] ) AND $trace[ 'class' ] === 'O2System\Gears\Tracer' )
			)
			{
				continue;
			}

			$line = new Trace\Chronology();

			if ( isset( $trace[ 'class' ] ) && isset( $trace[ 'type' ] ) )
			{
				$line->call = $trace[ 'class' ] . $trace[ 'type' ] . $trace[ 'function' ] . '()';
				$line->type = $trace[ 'type' ] === '->' ? 'non-static' : 'static';
			}
			else
			{
				$line->call = $trace[ 'function' ] . '()';
				$line->type = 'non-static';
			}

			if ( ! empty( $trace[ 'args' ] ) AND $line->call !== 'print_out()' )
			{
				$line->args = $trace[ 'args' ];
			}

			if ( ! isset( $trace[ 'file' ] ) )
			{
				$current_trace = current( $this->trace );
				$line->file    = @$current_trace[ 'file' ];
				$line->line    = @$current_trace[ 'line' ];
			}
			else
			{
				$line->file = @$trace[ 'file' ];
				$line->line = @$trace[ 'line' ];
			}

			$line->time   = microtime( TRUE ) - $this->benchmark[ 'time' ];
			$line->memory = number_format( round( memory_get_usage( TRUE ) / 1024 / 1024, 2 ), 4 ) . ' MB';

			$this->chronology[] = $line;

			if ( in_array( $trace[ 'function' ], [ 'print_out', 'print_line' ] ) )
			{
				break;
			}
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Chronology Method
	 *
	 * Backtrace chronology
	 *
	 * @access public
	 *
	 * @param   bool $reset option for resetting the chronology data
	 *
	 * @return  array
	 */
	public function chronology( $reset = TRUE )
	{
		$chronology = $this->chronology;

		if ( $reset === TRUE )
		{
			$this->chronology = [ ];
		}

		return $chronology;
	}
}