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

// ------------------------------------------------------------------------

use O2System\Gear\Profiler\Datastructures\Metric;

/**
 * Class Metrics
 *
 * @package O2System\Gear\Profiler\Collections
 */
class Metrics extends \SplQueue
{
    protected static $logged = [];

    // ------------------------------------------------------------------------

    public function push( $metric )
    {
        $metric->stop();

        if ( ! $this->isEmpty() ) {
            $metric->start($this->top()->endTime, $this->top()->endMemory);
        } elseif(defined('STARTUP_MEMORY')) {
            $metric->start(STARTUP_TIME, STARTUP_MEMORY);
        }

        parent::push( $metric );
    }

    // ------------------------------------------------------------------------

    /**
     * Return the current Benchmark
     *
     * @return Metric
     */
    public function current()
    {
        if ( null === ( $current = parent::current() ) ) {
            $this->rewind();
        }

        return parent::current();
    }
}