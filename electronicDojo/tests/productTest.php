<?php


namespace Tests\Unit;

use Tests\Support\UnitTester;

require 'Classes/productsClass.php';

//Test that validates if getters and setter methods function correctly
class productTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

   public function testGettersAndSetter(){

       $product = new \Product();


       //Set product object values using setter methods
       $product->setProductID(10);
       $product->setProductName("LG TV");
       $product->setBio("Best tv on the market");
       $product->setPrice(800);
       $product->setLoyaltyPoints(100);
       $product->setBrand("LG");
       $product->setCategory("Television");


       //test functionality of getter methods
       $this->assertEquals(10, $product->getProductID());
       $this->assertEquals("LG TV", $product->getProductName());
       $this->assertEquals("Best tv on the market", $product->getBio());
       $this->assertEquals(800, $product->getPrice());
       $this->assertEquals(100, $product->getLoyaltyPoints());
       $this->assertEquals("LG", $product->getBrand());
       $this->assertEquals("Television", $product->getCategory());
   }
}
