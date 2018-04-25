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
 * Class Toolbar
 *
 * @package O2System\Gear
 */
class Toolbar
{
    /**
     * Toolbar::__toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getOutput();
    }

    // ------------------------------------------------------------------------

    /**
     * Toolbar::getOutput
     *
     * @return string
     */
    public function getOutput()
    {
        $totalExecution = profiler()->getTotalExecution();
        $startTime = $totalExecution->getRawStartTime();
        $totalTime = ( microtime( true ) - $startTime ) * 1000;
        $profilerMetrics = profiler()->getMetrics();

        $increments = 1 / 5;
        $segmentDuration = ( ceil( ( $totalTime / 7 ) * $increments ) / $increments );
        $segmentCount = (int)ceil( $totalTime / $segmentDuration );

        $displayTime = $segmentCount * $segmentDuration;

        $metrics = [];
        foreach ( $profilerMetrics as $profilerMetric ) {
            $profilerMetric->offset = ( ( $profilerMetric->getRawStartTime() - $startTime ) * 1000 / $displayTime ) * 100;
            $profilerMetric->length = ( $profilerMetric->getRawDuration() * 1000 / $displayTime ) * 100;
            $metrics[] = $profilerMetric;
        }

        array_pop( $metrics );

        $metrics = array_reverse( $metrics );

        $files = $this->getFiles();
        $queries = $this->getQueries();
        $logs = $this->getLogs();
        $vars = $this->getVars();

        ob_start();
        include __DIR__ . '/Views/Toolbar.php';
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    // ------------------------------------------------------------------------

    /**
     * Toolbar::getFiles
     *
     * @return \string[]
     */
    public function getFiles()
    {
        $files = get_included_files();

        if ( class_exists( '\O2System\Framework', false ) ) {
            foreach ( $files as $key => $file ) {

                if ( strpos( $file, 'autoload.php' ) !== false ) {
                    unset( $files[ $key ] );
                    continue;
                }

                $files[ $key ] = str_replace( PATH_ROOT, DIRECTORY_SEPARATOR, $file );
            }
        }

        return $files;
    }

    // ------------------------------------------------------------------------

    public function getQueries()
    {
        return [];
    }

    /**
     * Toolbar::getLogs
     *
     * @return array
     */
    public function getLogs()
    {
        $logs = [];

        if ( function_exists( 'logger' ) ) {
            $logs = logger()->getLines();
        }

        return $logs;
    }

    // ------------------------------------------------------------------------

    /**
     * Toolbar::getVars
     *
     * @return \ArrayObject
     */
    public function getVars()
    {
        $vars = new \ArrayObject( [], \ArrayObject::ARRAY_AS_PROPS );

        $vars->env = $_ENV;
        $vars->server = $_SERVER;
        $vars->session = $_SESSION;
        $vars->cookies = $_COOKIE;
        $vars->get = $_GET;
        $vars->post = $_POST;
        $vars->files = $_FILES;

        if ( function_exists( 'apache_request_headers' ) ) {
            $vars->headers = apache_request_headers();
        } elseif ( function_exists( 'getallheaders' ) ) {
            $vars->headers = getallheaders();
        } else {
            $vars->headers = [];
            foreach ( $_SERVER as $name => $value ) {
                if ( substr( $name, 0, 5 ) == 'HTTP_' ) {
                    $vars->headers[ str_replace( ' ', '-',
                        ucwords( strtolower( str_replace( '_', ' ', substr( $name, 5 ) ) ) ) ) ] = $value;
                }
            }
        }

        return $vars;
    }
}