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

/**
 * Gear Helper
 *
 * Collections shortcut functions for Gear Output classes and other functions that
 * simplify the developers to perform debugging.
 *
 * @see http://o2system.io/user-guide/developers/gears.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_out' ) ) {
    /**
     * Print Out
     *
     * Equipping developers to issue any kind of variable output to the browser.
     *
     * @param mixed $vars
     * @param bool  $halt
     */
    function print_out ( $vars, $halt = true )
    {
        if ( php_sapi_name() === 'cli' ) {
            print_cli( $vars, $halt );
            return;
        }

        O2System\Gear\Screen::printScreen( $vars, $halt );
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_line' ) ) {
    /**
     * Print Line
     *
     * Equipping developers to issue any kind of variable output to the browser,
     * can be placed in various places in the source code program.
     *
     * @param string $line
     * @param bool   $halt
     */
    function print_line ( $line = '', $halt = false )
    {
        O2System\Gear\Screen::printLine( $line, $halt );
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_code' ) ) {
    /**
     * Print Code
     *
     * Make it easier for developers to issue any kind of variable output to the browser
     * inside pre tag.
     *
     * @param mixed $vars
     * @param bool  $halt
     */
    function print_code ( $vars, $halt = false )
    {
        O2System\Gear\Screen::printCode( $vars, $halt );
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_dump' ) ) {
    /**
     * Print Dump
     *
     * Make it easier for developers to dump any kind of variable output to the browser
     * inside pre tag.
     *
     * @param mixed $vars
     * @param bool  $halt
     */
    function print_dump ( $vars, $halt = true )
    {
        O2System\Gear\Screen::printDump( $vars, $halt );
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_json' ) ) {
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
    function print_json ( $vars, $option = null, $halt = true )
    {
        O2System\Gear\Screen::printJSON( $vars, $option, $halt );
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'print_console' ) ) {
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
    function print_console ( $title, $vars = [], $type = \O2System\Gear\Console::LOG )
    {
        O2System\Gear\Screen::printConsole( $title, $vars, $type );
    }
}

if ( ! function_exists( 'print_cli' ) ) {
    /**
     * print_cli
     *
     * print_r in command line interface.
     *
     * @param mixed $vars
     * @param bool  $halt
     */
    function print_cli ( $vars, $halt = true )
    {
        echo "------------------------------------------- print CLI ---- START" . PHP_EOL;
        print_r( $vars ) . PHP_EOL;
        echo "------------------------------------------- print CLI ---- END" . PHP_EOL;

        if ( $halt ) {
            die;
        }
    }
}

if ( ! function_exists( 'pre_open' ) ) {
    /**
     * Pre Open
     *
     * Echo a <pre> tag open HTML element.
     */
    function pre_open ()
    {
        echo '<pre>';
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'pre_line' ) ) {
    /**
     * Pre Line
     *
     * Echo a pre line content.
     *
     * @param mixed $line
     * @param bool  $implode
     */
    function pre_line ( $line, $implode = true )
    {
        if ( is_array( $line ) AND $implode === true ) {
            $line = implode( PHP_EOL, $line );
        } elseif ( is_bool( $line ) ) {
            if ( $line === true ) {
                $line = '(bool) TRUE';
            } else {
                $line = '(bool) FALSE';
            }
        } elseif ( is_resource( $line ) ) {
            $line = '(resource) ' . get_resource_type( $line );
        } elseif ( is_array( $line ) || is_object( $line ) ) {
            $line = @print_r( $line, true );
        } elseif ( is_int( $line ) OR is_numeric( $line ) ) {
            $line = '(int) ' . $line;
        } elseif ( is_null( $line ) ) {
            $line = '(null)';
        }

        echo $line . PHP_EOL;
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'pre_close' ) ) {
    /**
     * Pre Close
     *
     * Echo a </pre> tag close HTML element.
     *
     * @param bool $halt
     */
    function pre_close ( $halt = false )
    {
        echo '</pre>';

        if ( $halt ) {
            die;
        }
    }
}