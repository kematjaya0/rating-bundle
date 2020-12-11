<?php

namespace Kematjaya\RatingBundle\Twig;

use Kematjaya\RatingBundle\Helper\AbstractRatingHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class RatingExtension extends AbstractExtension 
{
    /**
     * 
     * @var AbstractRatingHelper
     */
    private $helper;
    
    public function __construct(AbstractRatingHelper $helper) 
    {
        $this->helper = $helper;
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('rating', [$this, 'renderRating'], ['is_safe' => ['html']]),
            new TwigFunction('convert', [$this, 'convert'], ['is_safe' => ['html']])
        ];
    }
    
    public function convert(float $value = 0, float $maxValue, float $max = null):float
    {
        if($max) {
            $this->helper->getCalculator()->setScale($max);
        }
        
        return $this->helper->getCalculator()->convert($value, $maxValue);
    }
    
    /**
     * render rating html using helper
     * @param float $value
     * @param int $max
     * @return string
     */
    public function renderRating(float $value = 0, int $max = null):string
    {
        return $this->helper->render($value, $max);
    }
    
}
