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
    private $trace = null;

    /**
     * Class Name
     *
     * @access  protected
     * @type    string name of called class
     */
    private $chronology = [ ];

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
        if ( ! empty( $trace ) ) {
            $this->trace = $trace;
        } else {
            $this->trace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
        }

        // reverse array to make steps line up chronologically
        $this->trace = array_reverse( $this->trace );

        // Generate Lines
        $this->getChronology();
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
    private function getChronology ()
    {
        foreach ( $this->trace as $trace ) {
            $line = new Trace\Chronology();

            if ( isset( $trace[ 'class' ] ) && isset( $trace[ 'type' ] ) ) {
                $line->call = $trace[ 'class' ] . $trace[ 'type' ] . $trace[ 'function' ] . '()';
                $line->type = $trace[ 'type' ] === '->' ? 'non-static' : 'static';
            } else {
                $line->call = $trace[ 'function' ] . '()';
                $line->type = 'non-static';
            }

            if ( ! isset( $trace[ 'file' ] ) ) {
                $currentTrace = current( $this->trace );
                $line->file = @$currentTrace[ 'file' ];
                $line->line = @$currentTrace[ 'line' ];
            } else {
                $line->file = @$trace[ 'file' ];
                $line->line = @$trace[ 'line' ];
            }

            if( defined('PATH_ROOT') ) {
                $line->file = str_replace(PATH_ROOT, '', $line->file);
            }

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