<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

final class RomanToLatinNumbersConverterTest extends TestCase {

    function setUp(): void {
        $this->numbersConverter = new \Roman\RomanToLatinNumbersConverter();
    }

    public function testMerge() {
        $romanNumberAsString = "CM.C DXCXLIXIV";
        $validRomanNumber = $this->numbersConverter->getValidNumber($romanNumberAsString);
<<<<<<< HEAD
        $result = $this->numbersConverter->convertToLatinNumber($romanNumberAsString);
=======
        $result = $this->numbersConverter->merge($romanNumberAsString);
>>>>>>> d85f67de72acfc2705888acf6ed105a542c66177
        $this->assertSame(1443, $result);

        echo "\n" . $validRomanNumber . " ist gleich " . $result;
    }

    public function testCalculate() {
<<<<<<< HEAD
        $latinNumbers = [100, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];
        $result = 1443;

        $this->assertSame($result, $this->numbersConverter->calculate($latinNumbers));
=======
        $validSemantic = true;
        $latinNumbers = [100, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];
        $result = 1443;

        $this->assertSame($result, $this->numbersConverter->calculate($validSemantic, $latinNumbers));
>>>>>>> d85f67de72acfc2705888acf6ed105a542c66177
    }

    public function testCalculate_Fail() {
        $validSemantic = false;
        $latinNumbers = [10, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];

<<<<<<< HEAD
        $this->assertFalse($this->numbersConverter->calculate($latinNumbers));
=======
        $this->assertFalse($this->numbersConverter->calculate($validSemantic, $latinNumbers));
>>>>>>> d85f67de72acfc2705888acf6ed105a542c66177
    }

    public function testGetValidRomanNumber() {
        $roman = "CM.C DXCXLIXIV";
        $this->assertSame("CMCDXCXLIXIV", $this->numbersConverter->getValidNumber($roman));
    }

    public function testValidateRomanNumber() {
        $letter = "C";

<<<<<<< HEAD
        $this->assertSame("C", $this->numbersConverter->getValidRomanLetter($letter));
=======
        $this->assertSame("C", $this->numbersConverter->validateRomanNumber($letter));
>>>>>>> d85f67de72acfc2705888acf6ed105a542c66177
    }

    public function testValidateRomanNumber_Null() {
        $letter = ".";

<<<<<<< HEAD
        $this->assertNull($this->numbersConverter->getValidRomanLetter($letter));
=======
        $this->assertNull($this->numbersConverter->validateRomanNumber($letter));
>>>>>>> d85f67de72acfc2705888acf6ed105a542c66177
    }

    public function testSwitchToLatinNumber() {
        $validRomanNumber = "DXCXLIXIV";
        $result = [500, 10, 100, 10, 50, 1, 10, 1, 5];
        $this->assertSame($result, $this->numbersConverter->switchToLatinNumbers($validRomanNumber));
    }

    public function testIsSemanticValid_True() {
        $latinNumberArray = [100, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];

        $this->assertTrue($this->numbersConverter->isSemanticValid($latinNumberArray));
    }

    public function testIsSemanticValid_False() {
        $latinNumbers = [10, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];

        $this->assertFalse($this->numbersConverter->isSemanticValid($latinNumbers));
    }

    public function testPerformSubstractionRule() {
        $latinNumbers = [100, 1000, 100, 500, 10, 100, 10, 50, 1, 10, 1, 5];
        $result = 1443;
        $this->assertSame($result, $this->numbersConverter->performSubstractionRule($latinNumbers));
    }

}
