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

namespace O2System\Gear\Profiler\Datastructures;

// ------------------------------------------------------------------------

/**
 * Class Metric
 *
 * @package O2System\Gear\Profiler\Datastructures
 */
class Metric
{
    protected $marker;

    protected $startTime;

    protected $endTime;

    protected $startMemory;

    protected $endMemory;

    // ------------------------------------------------------------------------

    /**
     * Metric constructor.
     *
     * @param $marker
     */
    public function __construct( $marker )
    {
        $this->marker = $marker;

        $this->start(
            microtime( true ),
            defined( 'STARTUP_MEMORY' ) ? memory_get_usage( true ) - STARTUP_MEMORY : memory_get_usage( true )
        );
    }

    // ------------------------------------------------------------------------

    public function start( $startTime = null, $startMemory = null )
    {
        $this->startTime = isset( $startTime ) ? $startTime : microtime( true );
        $this->startMemory = isset( $startMemory ) ? $startMemory : memory_get_usage( true );
    }

    // ------------------------------------------------------------------------

    public function getMarker()
    {
        return $this->marker;
    }

    // ------------------------------------------------------------------------

    public function getStartTime( $precision = 0, $floatingPrecision = 3, $showUnit = true )
    {
        return $this->getFormattedTime( $this->startTime, $precision, $floatingPrecision, $showUnit );
    }

    // ------------------------------------------------------------------------

    public function getFormattedTime(
        $time,
        $precision = 0,
        $floatingPrecision = 3,
        $showUnit = true
    ) {

        $test = is_int(
                $precision
            ) && $precision >= 0 && $precision <= 2 &&
            is_float( $time ) &&
            is_int( $floatingPrecision ) && $floatingPrecision >= 0 &&
            is_bool( $showUnit );

        if ( $test ) {
            $duration = round( $time * 10 * ( $precision * 3 ), $floatingPrecision );

            if ( $showUnit ) {
                switch ( $precision ) {
                    case 0 :
                        return $duration . ' s';
                    case 1 :
                        return $duration . ' ms';
                    case 2 :
                        return $duration . ' µs';
                    default :
                        return $duration . ' (no unit)';
                }
            } else {
                return $duration;
            }
        } else {
            return 'Can\'t return the render time';
        }
    }

    // ------------------------------------------------------------------------

    public function getRawStartTime()
    {
        return $this->startTime;
    }

    // ------------------------------------------------------------------------

    public function getRawEndTime()
    {
        if ( empty( $this->endTime ) ) {
            $this->stop();
        }

        return $this->endTime;
    }

    // ------------------------------------------------------------------------

    public function stop()
    {
        $this->endTime = microtime( true );
        $this->endMemory = memory_get_peak_usage( true ) - $this->startMemory;

        return $this;
    }

    // ------------------------------------------------------------------------

    public function getStartMemory()
    {
        return $this->getFormattedMemorySize( $this->startMemory );
    }

    // ------------------------------------------------------------------------

    private function getFormattedMemorySize( $size )
    {
        if ( $size < 1024 ) {
            return $size . " bytes";
        } elseif ( $size < 1048576 ) {
            return round( $size / 1024, 2 ) . " kilobytes";
        } else {
            return round( $size / 1048576, 2 ) . " megabytes";
        }
    }

    // ------------------------------------------------------------------------

    public function getEndTime( $precision = 0, $floatingPrecision = 3, $showUnit = true )
    {
        if ( empty( $this->endTime ) ) {
            $this->stop();
        }

        return $this->getFormattedTime( $this->endTime, $precision, $floatingPrecision, $showUnit );
    }

    // ------------------------------------------------------------------------

    public function getDuration( $precision = 0, $floatingPrecision = 3, $showUnit = true )
    {
        if ( empty( $this->endTime ) ) {
            $this->stop();
        }

        return $this->getFormattedTime( $this->endTime - $this->startTime, $precision, $floatingPrecision, $showUnit );
    }

    // ------------------------------------------------------------------------

    public function getRawDuration()
    {
        if ( empty( $this->endTime ) ) {
            $this->stop();
        }

        return $this->endTime - $this->startTime;
    }

    // ------------------------------------------------------------------------

    public function getMemory()
    {
        return $this->getEndMemory();
    }

    // ------------------------------------------------------------------------

    public function getEndMemory()
    {
        return $this->getFormattedMemorySize( $this->endMemory );
    }

    // ------------------------------------------------------------------------

    public function getPeakMemory()
    {
        return $this->getFormattedMemorySize( memory_get_peak_usage( true ) );
    }
}