<?php

namespace Kematjaya\RatingBundle\Calculator;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class RatingCalculator implements RatingCalculatorInterface
{
    /**
     *
     * @var int
     */
    private $scale = 5;
    
    public function getScale():int
    {
        return $this->scale;
    }
    
    public function setScale(int $scale):RatingCalculatorInterface
    {
        $this->scale = $scale;
        
        return $this;
    }
    
    public function convert(float $value, float $maxVal):float
    {
        $divider = $maxVal / $this->getScale();
        return $value / $divider;
    }
}
