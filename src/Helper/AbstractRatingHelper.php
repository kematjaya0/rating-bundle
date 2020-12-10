<?php

namespace Kematjaya\RatingBundle\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Kematjaya\RatingBundle\Calculator\RatingCalculatorInterface;
use Kematjaya\RatingBundle\Exception\EngineNotFound;
/**
 * Helper for render rating
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class AbstractRatingHelper implements RatingHelperInterface
{
    /**
     * 
     * @var RatingCalculatorInterface
     */
    protected $calculator;
    
    /**
     * 
     * @var ContainerInterface
     */
    protected $container;
    
    /**
     * 
     * @param ContainerInterface $container
     * @param RatingCalculatorInterface $calculator
     * @throws EngineNotFound
     */
    public function __construct(ContainerInterface $container, RatingCalculatorInterface $calculator) 
    {
        if(!$container->has('twig'))
        {
            throw new EngineNotFound();
        }
        
        $this->calculator = $calculator;
        $this->container = $container;
    }
    
    /**
     * 
     * @return ContainerInterface
     */
    public function getContainer():ContainerInterface
    {
        return $this->container;
    }
    
    /**
     * 
     * @return RatingCalculatorInterface
     */
    public function getCalculator():RatingCalculatorInterface
    {
        return $this->calculator;
    }
}
