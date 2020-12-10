<?php

namespace Kematjaya\RatingBundle\Helper;

use Kematjaya\RatingBundle\Exception\InvalidValueException;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class RatingHelper extends AbstractRatingHelper
{
    
    /**
     * render rating html using twig
     * @param float $value
     * @param int $max
     * @return string
     * @throws InvalidValueException
     */
    public function render(float $value, int $max = null): string 
    {
        if($max) {
            $this->getCalculator()->setScale($max);
        }
        
        $max = $this->getCalculator()->getScale();
        if($value > $max) {
            throw new InvalidValueException($value, $max);
        }
        
        return $this->getContainer()->get('twig')->render('@Rating/rating.html.twig', [
            'value' => $value, 'max' => $max
        ]);
    }

}
