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

use O2System\Gear\Profiler\Datastructures\Metric;

/**
 * O2System Gear Output
 *
 * @package O2System\Gear
 */
class Screen
{
    protected static $lines = [];

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
    public static function printJson( $vars, $option = null, $halt = true )
    {
        if ( is_bool( $option ) ) {
            $halt = $option;
            $option = null;
        }

        if ( is_numeric( $option ) ) {
            static::printScreen( json_encode( $vars, $option ), $halt );
        } else {
            static::printScreen( json_encode( $vars ), $halt );
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Print Out
     *
     * Equipping developers to issue any kind of variable output to the browser.
     *
     * @param mixed $vars string|array|object|integer|boolean
     * @param bool  $halt set FALSE to disabled halt output
     */
    public static function printScreen( $vars, $halt = true )
    {
        $metric = new Metric( 'print-out' );
        $metric->start();
        ini_set( 'memory_limit', '512M' );

        $vars = static::prepareOutput( $vars );
        $vars = htmlentities( $vars );
        $vars = htmlspecialchars( htmlspecialchars_decode( $vars, ENT_QUOTES ), ENT_QUOTES, 'UTF-8' );
        $trace = new Trace();
        $assetsURL = static::assetURL();

        $metric->stop();

        ob_start();
        include __DIR__ . '/Views/Screen.php';
        $output = ob_get_contents();
        ob_end_clean();

        echo $output;

        if ( $halt === true ) {
            die;
        }
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
        if ( is_bool( $vars ) ) {
            if ( $vars === true ) {
                $vars = '(bool) TRUE';
            } else {
                $vars = '(bool) FALSE';
            }
        } elseif ( is_resource( $vars ) ) {
            $vars = '(resource) ' . get_resource_type( $vars );
        } elseif ( is_array( $vars ) || is_object( $vars ) ) {
            $vars = @print_r( $vars, true );
        } elseif ( is_int( $vars ) OR is_numeric( $vars ) ) {
            $vars = '(int) ' . $vars;
        } elseif ( is_null( $vars ) ) {
            $vars = '(null)';
        }

        return $vars;
    }

    // ------------------------------------------------------------------------

    public static function assetURL()
    {
        $scriptFilename = str_replace( [ '/', '\\' ], '/', dirname( $_SERVER[ 'SCRIPT_FILENAME' ] ) );
        $scriptName = str_replace( [ '/', '\\' ], '/', dirname( $_SERVER[ 'SCRIPT_NAME' ] ) );
        $gearsDirectory = str_replace( [ '/', '\\' ], '/', __DIR__ );

        if ( strpos( $scriptFilename, 'public' ) ) {
            $scriptFilename = str_replace( 'public', '', $scriptFilename );
            $scriptName = str_replace( 'public', '', $scriptName );
        }

        return '//' . $_SERVER[ 'HTTP_HOST' ] . $scriptName . str_replace(
                $scriptFilename,
                '',
                $gearsDirectory
            ) . '/Views/assets/';
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
    public static function printLine( $line = '', $halt = false )
    {
        if ( strtoupper( $halt ) === 'FLUSH' ) {
            static::$lines = [];
            static::$lines[] = $line;
        }

        if ( is_array( $line ) || is_object( $line ) ) {
            static::$lines[] = print_r( $line, true );
        } else {
            static::$lines[] = static::prepareOutput( $line );
        }

        if ( $halt === true OR $line === '---' ) {
            $vars = implode( PHP_EOL, static::$lines );
            static::$lines = [];
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
    public static function printDump( $vars, $halt = true )
    {
        ob_start();
        var_dump( $vars );
        $output = ob_get_contents();
        ob_end_clean();

        static::printCode( $output, $halt );
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
    public static function printCode( $vars, $halt = true )
    {
        ini_set( 'memory_limit', '512M' );

        $vars = static::prepareOutput( $vars );
        $vars = htmlentities( $vars );
        $vars = htmlspecialchars( htmlspecialchars_decode( $vars, ENT_QUOTES ), ENT_QUOTES, 'UTF-8' );

        echo '<pre>' . $vars . '</pre>';

        if ( $halt === true ) {
            die;
        }
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
}