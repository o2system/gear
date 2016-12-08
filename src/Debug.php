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
 * O2System Gear Debug
 *
 * @package O2System\Gear
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
    public static function start ()
    {
        static::$chronology = [ ];
        static::$chronology[] = static::whereCall( __CLASS__ . '::start()' );
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
    private static function whereCall ( $call )
    {
        $tracer = new Trace();

        foreach ( $tracer->chronology() as $trace ) {
            if ( $trace->call === $call ) {
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
    public static function line ( $vars, $export = false )
    {
        $trace = static::whereCall( __CLASS__ . '::line()' );

        if ( $export === true ) {
            $trace->data = var_export( $vars, true );
        } else {
            $trace->data = Screen::prepareOutput( $vars );
        }

        static::$chronology[] = $trace;
    }

    // ------------------------------------------------------------------------

    /**
     * Marker
     *
     * Set Debug Marker
     */
    public static function marker ()
    {
        $trace = static::whereCall( __CLASS__ . '::marker()' );
        static::$chronology[] = $trace;
    }

    // ------------------------------------------------------------------------

    /**
     * Stop Debug
     *
     * @param bool $halt
     */
    public static function stop ( $halt = true )
    {
        static::$chronology[] = static::whereCall( __CLASS__ . '::stop()' );
        $chronology = static::$chronology;
        static::$chronology = [ ];

        Screen::printScreen( $chronology, $halt );
    }
}