<?php
/**
 * This file is part of the O2System PHP Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author         Steeve Andrian Salim
 * @copyright      Copyright (c) Steeve Andrian Salim
 */
// ------------------------------------------------------------------------

namespace O2System\Gear;

    // ------------------------------------------------------------------------

/**
 * O2System Gear Trace
 *
 * @package O2System\Gear
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
    private $trace = null;

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
    public function __construct ( $trace = [ ] )
    {
        global $startTime, $startMemory;

        $this->benchmark = [
            'time'   => $startTime,
            'memory' => $startMemory,
        ];

        if ( ! empty( $trace ) ) {
            $this->trace = $trace;
        } else {
            $this->trace = debug_backtrace();
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
    private function __generateChronology ()
    {
        foreach ( $this->trace as $trace ) {
            if ( in_array( $trace[ 'function' ], [ 'showException', 'showError', 'showPhpError', 'shutdown' ] ) OR
                 ( isset( $trace[ 'class' ] ) AND $trace[ 'class' ] === 'O2System\Core\Gear\Tracer' )
            ) {
                continue;
            }

            $line = new Trace\Chronology();

            if ( isset( $trace[ 'class' ] ) && isset( $trace[ 'type' ] ) ) {
                $line->call = $trace[ 'class' ] . $trace[ 'type' ] . $trace[ 'function' ] . '()';
                $line->type = $trace[ 'type' ] === '->' ? 'non-static' : 'static';
            } else {
                $line->call = $trace[ 'function' ] . '()';
                $line->type = 'non-static';
            }

            if ( ! empty( $trace[ 'args' ] ) AND $line->call !== 'print_out()' ) {
                $line->args = $trace[ 'args' ];
            }

            if ( ! isset( $trace[ 'file' ] ) ) {
                $currentTrace = current( $this->trace );
                $line->file = @$currentTrace[ 'file' ];
                $line->line = @$currentTrace[ 'line' ];
            } else {
                $line->file = @$trace[ 'file' ];
                $line->line = @$trace[ 'line' ];
            }

            $line->time = microtime( true ) - $this->benchmark[ 'time' ];
            $line->memory = round(
                                ( memory_get_usage( true ) - $this->benchmark[ 'memory' ] ) / 1024 / 1024,
                                2
                            ) . ' MB';

            $this->chronology[] = $line;

            if ( in_array( $line->call, [ 'print_out()', 'print_line()', 'O2System\Core\Gear\Debug::stop()' ] ) ) {
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
    public function chronology ( $reset = true )
    {
        $chronology = $this->chronology;

        if ( $reset === true ) {
            $this->chronology = [ ];
        }

        return $chronology;
    }
}