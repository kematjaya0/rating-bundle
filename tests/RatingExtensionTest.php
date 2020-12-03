<?php

namespace Kematjaya\RatingBundle\Test;

use Kematjaya\RatingBundle\Calculator\RatingCalculator;
use Kematjaya\RatingBundle\Twig\RatingExtension;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Kematjaya\RatingBundle\Test\AppKernelTest;
use Exception;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class RatingExtensionTest extends WebTestCase 
{
    public function testRenderException()
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $ext = new RatingExtension($container, new RatingCalculator());
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('10 greather than 5');
        $ext->renderRating(10);
    }
    
    public function testRenderNormal()
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $ext = new RatingExtension($container, new RatingCalculator());
        $this->assertTrue(is_string($ext->renderRating(4)));
    }
    
    public function testRenderConvert()
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $ext = new RatingExtension($container, new RatingCalculator());
        
        $this->assertEquals(1, $ext->convert(20, 100));
        $this->assertEquals(1.5, $ext->convert(30, 100));
        $this->assertEquals(2, $ext->convert(40, 100));
        $this->assertEquals(2.5, $ext->convert(50, 100));
        $this->assertEquals(3, $ext->convert(60, 100));
        $this->assertEquals(3.5, $ext->convert(70, 100));
        
        $this->assertEquals(7, $ext->convert(70, 100, 10));
    }
    
    public static function getKernelClass() 
    {
        return AppKernelTest::class;
    }
}
