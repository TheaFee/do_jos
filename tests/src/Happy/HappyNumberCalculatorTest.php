<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

final class HappyNumberCalculatorTest extends TestCase {

    function setUp(): void {
        $this->happyNumberCalculator = new \Happy\HappyNumberCalculator();
    }

    public function testToArray() {
        $number = 356;

        $this->assertCount(3, $this->happyNumberCalculator->toArray($number));
    }
    
    public function testEvaluateHappyNumberEquation(){
        $number = 19;
        //$numberAsArray = array(0=> 1, 1 => 9);
        
        $this->assertEquals(1, $this->happyNumberCalculator->evaluateHappyNumberEquation($number));
    }
    
        public function testNumberIterationWithNotHappyNumber(){
        $number = 21;
        //$numberAsArray = array(0=> 1, 1 => 9);
        
        $this->assertEquals(4, $this->happyNumberCalculator->evaluateHappyNumberEquation($number));
    }

    public function testFindAllHappyNumbers(){
        $beginNumber = 10;
        $endNumber = 20;
        $result = [10, 13, 19];
        $this->assertSame($result, $this->happyNumberCalculator->findAllHappyNumbersBetween($beginNumber, $endNumber));
        
        echo "Alle Happy Numbers zwischen " . $beginNumber . " und " . $endNumber . ": " ;
        print_r($result);
    }
}
