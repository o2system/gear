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

namespace O2System\Gear\Trace;

    // ------------------------------------------------------------------------

/**
 * O2System Gear Trace Chronology
 *
 * @package O2System\Gear\Trace
 */
class Chronology
{
    /**
     * Chronology Called Class::Function Name
     *
     * @var string
     */
    public $call;

    // ------------------------------------------------------------------------

    /**
     * Chronology Type
     *
     * @var string
     */
    public $type;

    // ------------------------------------------------------------------------

    /**
     * Chronology File Line Number
     *
     * @var int
     */
    public $line;

    // ------------------------------------------------------------------------

    /**
     * Chronology Execution Time Elapsed
     *
     * @var int
     */
    public $time;

    // ------------------------------------------------------------------------

    /**
     * Chronology Execution Memory Elapsed
     *
     * @var int
     */
    public $memory;

    // ------------------------------------------------------------------------

    /**
     * Chronology Function Called Arguments
     *
     * @var array
     */
    public $args;
}