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
 * O2System Gear Console
 *
 * @package O2System\Gear
 */
class Console
{
    const LOG_MESSAGE = 0;
    const INFO_MESSAGE = 1;
    const WARNING_MESSAGE = 2;
    const ERROR_MESSAGE = 3;
    const DEBUG_MESSAGE = 4;

    private $label;
    private $expression;
    private $messageType;

    // ------------------------------------------------------------------------

    public function __construct($label, $expression, $messageType = self::LOG_MESSAGE)
    {
        $this->label = $label;
        $this->expression = $expression;
        $this->messageType = $messageType;
    }

    public function send()
    {
        $this->expression = is_object($this->expression) || is_array($this->expression)
            ? 'JSON.parse(\'' . json_encode(
                $this->expression
            ) . '\')'
            : '\'' . $this->expression . '\'';

        echo '<script type="text/javascript">' . PHP_EOL;

        switch ($this->messageType) {
            default:
            case self::LOG_MESSAGE :
                $messageType = 'log';
                $backgroundColor = '#777777';
                $textColor = '#ffffff';
                break;
            case self::INFO_MESSAGE :
                $messageType = 'info';
                $backgroundColor = '#5bc0de';
                $textColor = '#ffffff';
                break;
            case self::WARNING_MESSAGE :
                $messageType = 'warn';
                $backgroundColor = '#f0ad4e';
                $textColor = '#ffffff';
                break;
            case self::ERROR_MESSAGE :
                $messageType = 'error';
                $backgroundColor = '#d9534f';
                $textColor = '#ffffff';
                break;
            case self::DEBUG_MESSAGE :
                $messageType = 'debug';
                $backgroundColor = '#333333';
                $textColor = '#ffffff';
                break;
        }

        if ( ! empty($this->label)) {
            echo "console." . $messageType . "('%c " . $this->label . " ', 'background: " . $backgroundColor . "; color: " . $textColor . "');" . PHP_EOL;
        }

        echo "console." . $messageType . "(" . $this->expression . ");" . PHP_EOL;

        echo '</script>' . PHP_EOL;
    }
}