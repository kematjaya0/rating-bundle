<?php

namespace Kematjaya\RatingBundle\Exception;

use Exception;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class InvalidValueException extends Exception 
{
    public function __construct(float $value, float $max, string $message = "", int $code = 0, \Throwable $previous = NULL) 
    {
        $message = sprintf("%s greather than %s %s", $value, $max, $message);
        parent::__construct($message, $code, $previous);
    }
}
