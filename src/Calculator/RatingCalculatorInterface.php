<?php

namespace Kematjaya\RatingBundle\Calculator;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface RatingCalculatorInterface 
{
    public function getScale():int;
    
    public function setScale(int $scale):self;
    
    public function convert(float $value, float $maxVal):float;
}
