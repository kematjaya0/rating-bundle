<?php

namespace Kematjaya\RatingBundle\Helper;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface RatingHelperInterface 
{
    public function render(float $value = 0, int $max = null, array $attributes = []):string;
}
