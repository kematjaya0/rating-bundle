<?php

namespace Kematjaya\RatingBundle\Twig;

use Kematjaya\RatingBundle\Calculator\RatingCalculator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class RatingExtension extends AbstractExtension 
{
    /**
     *
     * @var ContainerInterface
     */
    private $container;
    
    private $calculator;
    
    public function __construct(ContainerInterface $container, RatingCalculator $calculator) 
    {
        $this->container = $container;
        $this->calculator = $calculator;
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('rating', [$this, 'renderRating'], ['is_safe' => ['html']]),
            new TwigFunction('convert', [$this, 'convert'], ['is_safe' => ['html']])
        ];
    }
    
    public function convert(float $value, float $maxValue, float $max = null):float
    {
        if($max)
        {
            $this->calculator->setScale($max);
        }
        
        return $this->calculator->convert($value, $maxValue);
    }
    
    public function renderRating(float $value, int $max = null)
    {
        if(!$this->container->has('twig'))
        {
            throw new Exception(sprintf('template engine is not installed, try %s', 'composer require twig'));
        }
        
        if($max)
        {
            $this->calculator->setScale($max);
        }
        
        $max = $this->calculator->getScale();
        if($value > $max)
        {
            throw new Exception(sprintf("%s greather than %s", $value, $max));
        }
        
        return $this->container->get('twig')->render('@Rating/rating.html.twig', [
            'value' => $value, 'max' => $max
        ]);
    }
    
}
