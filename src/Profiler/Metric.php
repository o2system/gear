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

use O2System\Gear\Profiler\Collections\Metrics;

class Metric
{
    public $called;

    public $class;

    public $function;

    public $file;

    public $line;

    public $benchmark;

    public $internalMetrics;

    public function __construct ( array $metric = [ ] )
    {
        $this->called = empty( $metric[ 'class' ] ) ? $metric[ 'function' ] . '()' : $metric[ 'class' ] . $metric[ 'type' ] . $metric[ 'function' ] . '()';
        $this->class = @$metric[ 'class' ];
        $this->function = @$metric[ 'function' ];
        $this->file = @$metric[ 'file' ];
        $this->line = @$metric[ 'line' ];

        $this->benchmark = new Benchmark( $this->called );
        $this->internalMetrics = new Metrics();
    }

    public function addInternalMetric ( Metric $metric )
    {
        if ( $metric->called !== $this->called ) {
            $this->internalMetrics[ $metric->called ] = $metric;
        }
    }
}