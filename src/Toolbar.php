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

class Toolbar
{
    public function __toString ()
    {
        return $this->getOutput();
    }

    public function getOutput ()
    {
        $totalExecution = profiler()->getTotalExecution();
        $startTime = $totalExecution->getRawStartTime();
        $totalTime = ( microtime( true ) - $startTime ) * 1000;
        $profilerMetrics = profiler()->getMetrics();

        $segmentDuration = $this->roundTo( $totalTime / 7, 5 );
        $segmentCount = (int) ceil( $totalTime / $segmentDuration );

        $displayTime = $segmentCount * $segmentDuration;

        $metrics = [ ];
        foreach ( $profilerMetrics as $profilerMetric ) {
            $profilerMetric->offset = ( ( $profilerMetric->getRawStartTime(
                        ) - $startTime ) * 1000 / $displayTime ) * 100;
            $profilerMetric->length = ( $profilerMetric->getRawDuration() * 1000 / $displayTime ) * 100;
            $metrics[] = $profilerMetric;
        }

        array_pop( $metrics );

        $metrics = array_reverse( $metrics );

        $files = $this->getFiles();
        $logs = $this->getLogs();
        $vars = $this->getVars();

        ob_start();
        include __DIR__ . '/Views/Toolbar.php';
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    public function getFiles ()
    {
        $files = get_included_files();

        if ( class_exists( '\O2System\Framework', false ) ) {
            foreach ( $files as $key => $file ) {

                if ( strpos( $file, 'autoload.php' ) !== false ) {
                    unset( $files[ $key ] );
                    continue;
                }

                $files[ $key ] = str_replace(
                    [
                        PATH_KERNEL,
                        PATH_FRAMEWORK,
                        PATH_APP,
                        PATH_PUBLIC,
                        __DIR__ . DIRECTORY_SEPARATOR,
                        PATH_VENDOR,
                    ],
                    [
                        'PATH_KERNEL' . DIRECTORY_SEPARATOR,
                        'PATH_FRAMEWORK' . DIRECTORY_SEPARATOR,
                        'PATH_APP' . DIRECTORY_SEPARATOR,
                        'PATH_PUBLIC' . DIRECTORY_SEPARATOR,
                        'PATH_GEAR' . DIRECTORY_SEPARATOR,
                        'PATH_VENDOR' . DIRECTORY_SEPARATOR,
                    ],
                    $file
                );
            }
        }

        return $files;
    }

    public function getLogs ()
    {
        $logs = [ ];

        if ( function_exists( 'logger' ) ) {
            $logs = logger()->getLines();

            return $logs;
        }
    }

    public function getVars ()
    {
        $vars = new \ArrayObject( [ ], \ArrayObject::ARRAY_AS_PROPS );

        $vars->env =& $_ENV;
        $vars->server =& $_SERVER;
        $vars->session =& $_SESSION;
        $vars->cookies =& $_COOKIE;
        $vars->get =& $_GET;
        $vars->post =& $_POST;
        $vars->files =& $_FILES;

        return $vars;
    }

    /**
     * Rounds a number to the nearest incremental value.
     *
     * @param     $number
     * @param int $increments
     *
     * @return float
     */
    protected function roundTo ( $number, $increments = 5 )
    {
        $increments = 1 / $increments;

        return ( ceil( $number * $increments ) / $increments );
    }

    //--------------------------------------------------------------------
}