<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rot13EncryptionTest
 *
 * @author thea
 */
class RotatingEncryptionTest extends TestCase {

    protected function setUp(): void {
        parent::setUp();

        $this->rotatingEncryption = new \RotatingEncryption\RotatingEncryption();
    }

    public function convertToAsciiUppercase() {
        $givenSentence = "Olé Garçon! Diese Süßspeise schmeckt gar nicht übel! *börp*";

        $convertedSentence = "OLE GARCON! DIESE SUESSSPEISE SCHMECKT GAR NICHT UEBEL! *BOERP*";

        $this->assertSame($convertedSentence, $this->rotatingEncryption->convertToAsciiUppercase($givenSentence));
    }

    public function testGetCodePoints() {
        $sentenceInAscii = "HELLO, WORLD!";

        $asciiCodePoints = [72, 69, 76, 76, 79, 44, 32, 87, 79, 82, 76, 68, 33];

        $this->assertSame($asciiCodePoints, $this->rotatingEncryption->getCodePoints($sentenceInAscii));
    }

    public function testPerformEncryption() {
        $codePoints = [72, 69, 76, 76, 79, 44, 32, 87, 79, 82, 76, 68, 33];

        $encryptionOffset = 13;
        $encryptedCodePoints = [85, 82, 89, 89, 66, 44, 32, 74, 66, 69, 89, 81, 33];

        $this->assertSame($encryptedCodePoints, $this->rotatingEncryption->performEncryption($codePoints, $encryptionOffset));
    }

    public function testrot13_72() {
        $codePoint = 72;
        $encryptionOffset = 13;
        $rotatedCodePoint = 85;

        $this->assertSame($rotatedCodePoint, $this->rotatingEncryption->rotation($codePoint, $encryptionOffset));
    }

    public function testrot13_79() {
        $codePoint = 79;
        $encryptionOffset = 13;
        $rotatedCodePoint = 66;

        $this->assertSame($rotatedCodePoint, $this->rotatingEncryption->rotation($codePoint, $encryptionOffset));
    }

    public function testrot13_33() {
        $codePoint = 33;
        $encryptionOffset = 13;
        $rotatedCodePoint = 33;

        $this->assertSame($rotatedCodePoint, $this->rotatingEncryption->rotation($codePoint, $encryptionOffset));
    }

    public function testrot20_79() {
        $codePoint = 79;
        $encryptionOffset = 20;
        $rotationCodePoint = 73;

        $this->assertSame($rotationCodePoint, $this->rotatingEncryption->rotation($codePoint, $encryptionOffset));
    }

    public function testIsCodePointALetter_True() {
        $codePoint = 65;

        $this->assertTrue($this->rotatingEncryption->isCodePointALetter($codePoint));
    }

    public function testIsCodePointALetter_False() {
        $codePoint = 33;

        $this->assertFalse($this->rotatingEncryption->isCodePointALetter($codePoint));
    }

    public function testConvertToLetters() {
        $encryptedCodePoints = [85, 82, 89, 89, 66, 44, 32, 74, 66, 69, 89, 81, 33];
        $rotatedResult = 'URYYB, JBEYQ!';

        $this->assertSame($rotatedResult, $this->rotatingEncryption->convertToLetters($encryptedCodePoints));
    }

}
