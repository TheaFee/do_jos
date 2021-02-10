<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

final class RomanToLatinNumbersConverterTest extends TestCase {

    private \Roman\RomanToLatinNumbersConverter $numbersConverter;

    protected function setUp(): void {
        parent::setUp();
        $this->numbersConverter = new \Roman\RomanToLatinNumbersConverter();
    }

    public function testMerge() {
        $romanNumberAsString = "CM.C DXCXLIXIV";
        $validRomanNumber = $this->numbersConverter->getValidNumber($romanNumberAsString);
        $result = $this->numbersConverter->convertToLatinNumber($romanNumberAsString);

        $this->assertSame(1443, $result);

        echo "\n" . $validRomanNumber . " ist gleich " . $result;
    }

    public function testCalculate() {
        $latinNumbers = [100, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];
        $result = 1443;
        $mock = new \Roman\RomanToLatinNumbersConverter();
        $property = $this->getLatinNumbersArray($mock);
        $property->setValue($mock, $latinNumbers);

        $this->assertEquals($result, $mock->calculate());
    }

    public function testCalculate_Fail() {
        $latinNumbers = [10, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];
        $mock = new \Roman\RomanToLatinNumbersConverter();
        $property = $this->getLatinNumbersArray($mock);
        $property->setValue($mock, $latinNumbers);

        $this->assertFalse($this->numbersConverter->calculate());
    }

    public function testGetValidRomanNumber() {
        $roman = "CM.C DXCXLIXIV";
        $this->assertSame("CMCDXCXLIXIV", $this->numbersConverter->getValidNumber($roman));
    }

    public function testValidateRomanNumber() {
        $letter = "C";

        $this->assertSame("C", $this->numbersConverter->getValidRomanLetter($letter));
    }

    public function testValidateRomanNumber_Null() {
        $letter = ".";

        $this->assertNull($this->numbersConverter->getValidRomanLetter($letter));
    }

    public function testSwitchToLatinNumbers() {
        $validRomanNumber = "DXCXLIXIV";
        $latinNumbersArray = [];

        $mock = new \Roman\RomanToLatinNumbersConverter();
        $property = $this->getLatinNumbersArray($mock);
        $property->setValue($mock, $latinNumbersArray);

        $mock->switchToLatinNumbers($validRomanNumber);
        $actual = $property->getValue($mock);

        $expected = [500, 10, 100, 10, 50, 1, 10, 1, 5];
        $this->assertEquals($expected, $actual);
    }

    public function testIsSemanticValid_True() {
        $latinNumberArray = [100, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];
        $mock = new \Roman\RomanToLatinNumbersConverter();
        $property = $this->getLatinNumbersArray($mock);
        $property->setValue($mock, $latinNumberArray);

        $this->assertTrue($mock->isSemanticValid());
    }

    public function testIsSemanticValid_False() {
        $latinNumberArray = [10, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];
        $mock = new \Roman\RomanToLatinNumbersConverter();
        $property = $this->getLatinNumbersArray($mock);
        $property->setValue($mock, $latinNumberArray);

        $this->assertFalse($mock->isSemanticValid());
    }

    public function testPerformSubstractionRule() {
        $latinNumberArray = [100, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];
        $result = 1443;
        $mock = new \Roman\RomanToLatinNumbersConverter();
        $property = $this->getLatinNumbersArray($mock);
        $property->setValue($mock, $latinNumberArray);
        
        $this->assertSame($result, $mock->performSubstractionRule());
    }

    private function getLatinNumbersArray($mock) {

        $reflector = new ReflectionClass($mock);
        $property = $reflector->getProperty('latinNumbersArray');
        $property->setAccessible(true);
        
        return $property;
    }

}
