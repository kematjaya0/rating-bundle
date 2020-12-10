<?php

namespace Kematjaya\RatingBundle\Helper;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface RatingHelperInterface 
{
    public function render(float $value, int $max = null):string;
}
