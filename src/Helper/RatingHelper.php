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
    public function render(float $value = 0, int $max = null, array $attributes = []): string 
    {
        $value = ($value >= 0) ? $value : 0;
        if($max) {
            $this->getCalculator()->setScale($max);
        }
        
        $max = $this->getCalculator()->getScale();
        if($value > $max) {
            throw new InvalidValueException($value, $max);
        }
        
        $attributes['fillIcon'] = (isset($attributes['fillIcon'])) ? $attributes['fillIcon'] : 'fa fa-star';
        $attributes['emptyIcon'] = (isset($attributes['emptyIcon'])) ? $attributes['emptyIcon'] : 'fa fa-star';
        
        return $this->getContainer()->get('twig')->render('@Rating/rating.html.twig', [
            'value' => $value, 'max' => $max, 'attributes' => $attributes
        ]);
    }

}
