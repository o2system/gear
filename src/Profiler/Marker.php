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

namespace O2System\Gear\Profiler;

class Marker
{
    const PRECISION_SECOND      = 0;

    const PRECISION_MILLISECOND = 1;

    const PRECISION_MICROSECOND = 2;

    protected $marker;

    protected $startTime;

    protected $endTime;

    protected $startMemory;

    protected $endMemory;

    public function __construct ( $marker )
    {
        $this->marker = $marker;

        $this->start();
    }

    public function start ( $startTime = null, $startMemory = null )
    {
        $this->startTime = isset( $startTime ) ? $startTime : microtime( true );
        $this->startMemory = isset( $startMemory ) ? $startMemory : memory_get_usage( true );
    }

    public function getMarker ()
    {
        return $this->marker;
    }

    public function getExecutionMemory ()
    {
        if ( empty( $this->endMemory ) ) {
            $this->stop();
        }

        return $this->__formatMemorySize( $this->endMemory - $this->startMemory );
    }

    public function stop ()
    {
        $this->endTime = microtime( true );
        $this->endMemory = memory_get_usage( true );

        return $this;
    }

    private function __formatMemorySize ( $size )
    {
        if ( $size < 1024 ) {
            return $size . " bytes";
        } elseif ( $size < 1048576 ) {
            return round( $size / 1024, 2 ) . " kilobytes";
        } else {
            return round( $size / 1048576, 2 ) . " megabytes";
        }
    }

    public function getPeakMemory ()
    {
        return $this->__formatMemorySize( memory_get_peak_usage( true ) );
    }

    public function getExecutionTime (
        $precision = self::PRECISION_MILLISECOND,
        $floatingPrecision = 3,
        $showUnit = true
    ) {
        if ( empty( $this->endTime ) ) {
            $this->stop();
        }

        $test = is_int(
                    $precision
                ) && $precision >= self::PRECISION_SECOND && $precision <= self::PRECISION_MICROSECOND &&
                is_float( $this->startTime ) && is_float( $this->endTime ) && $this->startTime <= $this->endTime &&
                is_int( $floatingPrecision ) && $floatingPrecision >= 0 &&
                is_bool( $showUnit );

        if ( $test ) {
            $duration = round( ( $this->endTime - $this->startTime ) * 10 ** ( $precision * 3 ), $floatingPrecision );

            if ( $showUnit ) {
                return $duration . ' ' . $this->__formatTime( $precision );
            } else {
                return $duration;
            }
        } else {
            return 'Can\'t return the render time';
        }
    }

    private function __formatTime ( $precision )
    {
        switch ( $precision ) {
            case self::PRECISION_SECOND :
                return 's';
            case self::PRECISION_MILLISECOND :
                return 'ms';
            case self::PRECISION_MICROSECOND :
                return 'µs';
            default :
                return '(no unit)';
        }
    }
}