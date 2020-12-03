<?php

namespace Kematjaya\RatingBundle\Twig;

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
    
    public function __construct(ContainerInterface $container) 
    {
        $this->container = $container;
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('rating', [$this, 'renderRating'], ['is_safe' => ['html']])
        ];
    }
    
    public function renderRating(float $value, int $max = 5)
    {
        if(!$this->container->has('twig'))
        {
            throw new Exception(sprintf('template engine is not installed, try %s', 'composer require twig'));
        }
        
        if($value > $max)
        {
            throw new Exception(sprintf("%s greather than %s", $value, $max));
        }
        
        return $this->container->get('twig')->render('@Rating/rating.html.twig', [
            'value' => $value, 'max' => $max
        ]);
    }
    
}
