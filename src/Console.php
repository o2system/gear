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

use PhpConsole\Handler;

/**
 * O2System Gear Console
 *
 * @package O2System\Gear
 */
class Console
{
    /**
     * Console Log
     *
     * @var int
     */
    const LOG = 1;

    /**
     * Console Info
     *
     * @var int
     */
    const INFO = 2;

    /**
     * Console Warnine
     *
     * @var int
     */
    const WARNING = 3;

    /**
     * Console Error
     *
     * @var int
     */
    const ERROR = 4;

    // ------------------------------------------------------------------------

    /**
     * Log
     *
     * Send output to browser log console
     *
     * @access  public
     * @static  static class method
     *
     * @param   string $label string of output title
     * @param   mixed  $vars  mixed type variables of data
     */
    public static function log ( $label, $vars )
    {
        static::sendOutput( static::LOG, $label, $vars );
    }
    // ------------------------------------------------------------------------

    /**
     * Send Output
     *
     * Send output to browser debug console
     *
     * @access  public
     * @static  static class method
     *
     * @param   int    $type  console type
     * @param   string $label string of output title
     * @param   mixed  $vars  mixed type variables of data
     */
    public static function sendOutput ( $type, $label, $vars )
    {
        $phpConsoleHandler = Handler::getInstance();
        $phpConsoleHandler->start(); // start handling PHP errors & exceptions

        $sourceBasePath = defined( 'ROOTPATH' ) ? ROOTPATH : dirname( $_SERVER[ 'SCRIPT_FILENAME' ] );

        $phpConsoleHandler->getConnector()->setSourcesBasePath( $sourceBasePath );

        echo '<script type="text/javascript">' . PHP_EOL;
        switch ( $type ) {
            default:
            case 1:
                $phpConsoleHandler->debug( $vars, $label );
                echo "console.debug('%c $label ', 'background: #777; color: #fff');" . PHP_EOL;
                break;
            case 2:
                echo "console.info('%c $label ', 'background: #5bc0de; color: #fff');" . PHP_EOL;
                break;
            case 3:
                echo "console.warn('%c $label ', 'background: #f0ad4e; color: #fff');" . PHP_EOL;
                break;
            case 4:
                echo "console.error('%c $label ', 'background: #d9534f; color: #fff');" . PHP_EOL;
                break;
        }

        if ( ! empty( $vars ) ) {
            $vars = is_object( $vars ) || is_array( $vars ) ? 'JSON.parse(\'' . json_encode(
                    $vars
                ) . '\')' : '\'' . $vars . '\'';

            switch ( $type ) {
                default:
                case 1:
                    echo "console.debug($vars);" . PHP_EOL;
                    break;
                case 2:
                    echo "console.info($vars);" . PHP_EOL;
                    break;
                case 3:
                    echo "console.warn($vars);" . PHP_EOL;
                    break;
                case 4:
                    echo "console.error($vars);" . PHP_EOL;
                    break;
            }
        }
        echo '</script>' . PHP_EOL;
    }

    // ------------------------------------------------------------------------

    /**
     * Info
     *
     * Send output to browser info console
     *
     * @access  public
     * @static  static class method
     *
     * @param   string $label string of output title
     * @param   mixed  $vars  mixed type variables of data
     */
    public static function info ( $label, $vars )
    {
        static::sendOutput( static::INFO, $label, $vars );
    }

    // ------------------------------------------------------------------------

    /**
     * Warning
     *
     * Send output to browser warning console
     *
     * @access  public
     * @static  static class method
     *
     * @param   string $label string of output title
     * @param   mixed  $vars  mixed type variables of data
     */
    public static function warning ( $label, $vars )
    {
        static::sendOutput( static::WARNING, $label, $vars );
    }
    // ------------------------------------------------------------------------

    /**
     * Error
     *
     * Send output to browser error console
     *
     * @access  public
     * @static  static class method
     *
     * @param   string $label string of output title
     * @param   mixed  $vars  mixed type variables of data
     */
    public static function error ( $label, $vars )
    {
        static::sendOutput( static::ERROR, $label, $vars );
    }
}