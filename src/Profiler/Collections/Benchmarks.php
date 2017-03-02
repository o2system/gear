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
namespace O2System\Gear\Profiler\Collections;


use O2System\Gear\Profiler\Benchmark;

class Benchmarks extends \SplStack
{
    public function push ( $benchmark )
    {
        if ( $this->isEmpty() === false AND null !== $this->top() ) {
            $this->top()->stop();
        }

        parent::push( $benchmark );
    }

    // ------------------------------------------------------------------------

    /**
     * Return the current Benchmark
     *
     * @return Benchmark
     */
    public function current ()
    {
        if ( null === ( $current = parent::current() ) ) {
            $this->rewind();
        }

        return parent::current();
    }
}