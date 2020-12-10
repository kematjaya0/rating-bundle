<?php

namespace Kematjaya\RatingBundle\Exception;

use Exception;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class EngineNotFound extends Exception
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = NULL) 
    {
        $message = sprintf('template engine is not installed, try %s %s', 'composer require twig', $message);
        parent::__construct($message, $code, $previous);
    }
}
