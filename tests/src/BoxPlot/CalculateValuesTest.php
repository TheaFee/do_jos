<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalculateValuesTest
 *
 * @author thea
 */
class CalculateValuesTest extends TestCase {
    public $boxPlot;

    public function setUp(): void {
        $this->boxPlot = new \BoxPlot\CalculateValues();
    }

    public function testSortArray() {
        $actual = [25, 24, 18, 19, 18, 19, 20, 24, 17];
        $expected = [17, 18, 18, 19, 19, 20, 24, 24, 25];

        $this->assertEquals($expected, $this->boxPlot->sortArray($actual));
    }

    public function testGetMinNumber() {
        $array = [17, 18, 18, 19, 19, 20, 24, 24, 25];
        $expectedValue = 17;

        $this->assertEquals($expectedValue, $this->boxPlot->getMinNumber($array));
    }

    public function testGetMaxNumber() {
        $array = [17, 18, 18, 19, 19, 20, 24, 24, 25];
        $expectedValue = 25;

        $this->assertEquals($expectedValue, $this->boxPlot->getMaxNumber($array));
    }

    public function testGetMedian_EvenCountOfNumbers() {
        $array = [17, 18, 18, 19, 19, 20, 24, 24, 24, 25];
        $expectedValue = 20; 

        $this->assertEquals($expectedValue, $this->boxPlot->getMedian($array));
    }
    
        public function testGetMedian_OddCountOfNumbers() {
        $array = [17, 18, 18, 19, 19, 20, 24, 24, 25];
        $expectedValue = 19;

        $this->assertEquals($expectedValue, $this->boxPlot->getMedian($array));
    }
    
    public function testGetLowerQuartil_EvenCountOfNumbers() {
        $array = [17, 18, 18, 19, 19, 20, 24, 24, 24, 25];
        $expectedValue = 18.25;

        $this->assertEquals($expectedValue, $this->boxPlot->getLowerQuartil($array));
    }
    
     public function testGetLowerQuartil_OddCountOfNumbers() {
        $array = [17, 18, 18, 19, 19, 20, 24, 24, 25];
        $expectedValue = 18;

        $this->assertEquals($expectedValue, $this->boxPlot->getLowerQuartil($array));
    }
    
        public function testGetHigherQuartil_EvenCountOfNumbers() {
        $array = [17, 18, 18, 19, 19, 20, 24, 24, 24, 25];
        $expectedValue = 24;

        $this->assertEquals($expectedValue, $this->boxPlot->getHigherQuartil($array));
    }
    
     public function testGetHigherQuartil_OddCountOfNumbers() {
        $array = [17, 18, 18, 19, 19, 20, 24, 24, 25];
        $expectedValue = 24;

        $this->assertEquals($expectedValue, $this->boxPlot->getHigherQuartil($array));
    }
}
