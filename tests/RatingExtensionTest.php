<?php

namespace Kematjaya\RatingBundle\Test;

use Kematjaya\RatingBundle\Exception\InvalidValueException;
use Kematjaya\RatingBundle\Helper\RatingHelper;
use Kematjaya\RatingBundle\Helper\RatingHelperInterface;
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
    public function testInstanceHelper():RatingHelperInterface
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $helper = new RatingHelper($container, new RatingCalculator());
        $this->assertInstanceOf(RatingHelperInterface::class, $helper);
        
        return $helper;
    }
    
    /**
     * @depends testInstanceHelper
     */
    public function testRenderException(RatingHelperInterface $helper)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('10 greather than 5');
        $helper->render(10);
    }
    
    /**
     * @depends testInstanceHelper
     */
    public function testRenderSuccess(RatingHelperInterface $helper)
    {
        $this->assertIsString($helper->render(1));
        $this->assertIsString($helper->render(2));
        $this->assertIsString($helper->render(3));
        $this->assertIsString($helper->render(4));
        $this->assertIsString($helper->render(5));
    }
    
    private function renderStar(int $offset)
    {
        $html = '';
        for($i = 0; $i< $offset; $i++) {
            $html .= '<i class="fa fa-star" style="color: coral"></i>';
        }
        
        return $html;
    }
  
    /**
     * @depends testInstanceHelper
     */
    public function testRenderConvert(RatingHelperInterface $helper)
    {
        $ext = new RatingExtension($helper);
        
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
