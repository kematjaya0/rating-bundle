<?php

namespace Kematjaya\RatingBundle\Test;

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
        $ext = new RatingExtension($container);
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('10 greather than 5');
        $ext->renderRating(10);
    }
    
    public function testRenderNormal()
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $ext = new RatingExtension($container);
        $this->assertTrue(is_string($ext->renderRating(4)));
    }
    
    public static function getKernelClass() 
    {
        return AppKernelTest::class;
    }
}
