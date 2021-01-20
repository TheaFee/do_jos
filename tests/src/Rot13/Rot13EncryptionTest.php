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
class Rot13EncryptionTest extends TestCase {

    protected function setUp(): void {
        parent::setUp();

        $this->rot13Encryption = new \Rot13\Rot13Encryption();
    }

    public function convertToAsciiUppercase() {
        $givenSentence = "Olé Garçon! Diese Süßspeise schmeckt gar nicht übel! *börp*";

        $convertedSentence = "OLE GARCON! DIESE SUESSSPEISE SCHMECKT GAR NICHT UEBEL! *BOERP*";

        $this->assertSame($convertedSentence, $this->rot13Encryption->convertToAsciiUppercase($givenSentence));
    }

    public function testGetCodePoints() {
        $sentenceInAscii = "HELLO, WORLD!";

        $asciiCodePoints = [72, 69, 76, 76, 79, 44, 32, 87, 79, 82, 76, 68, 33];

        $this->assertSame($asciiCodePoints, $this->rot13Encryption->getCodePoints($sentenceInAscii));
    }

    public function testPerformEncryption() {
        $codePoints = [72, 69, 76, 76, 79, 44, 32, 87, 79, 82, 76, 68, 33];

        $encryptionOffset = 13;
        $encryptedCodePoints = [85, 82, 89, 89, 66, 44, 32, 74, 66, 69, 89, 81, 33];

        $this->assertSame($encryptedCodePoints, $this->rot13Encryption->performEncryption($codePoints, $encryptionOffset));
    }

    public function testrot13_72() {
        $codePoint = 72;
        $encryptionOffset = 13;
        $rot13CodePoint = 85;

        $this->assertSame($rot13CodePoint, $this->rot13Encryption->rot13($codePoint, $encryptionOffset));
    }

    public function testrot13_79() {
        $codePoint = 79;
        $encryptionOffset = 13;
        $rot13CodePoint = 66;

        $this->assertSame($rot13CodePoint, $this->rot13Encryption->rot13($codePoint, $encryptionOffset));
    }

    public function testrot13_33() {
        $codePoint = 33;
        $encryptionOffset = 13;
        $rot13CodePoint = 33;

        $this->assertSame($rot13CodePoint, $this->rot13Encryption->rot13($codePoint, $encryptionOffset));
    }

    public function testConvertToLetters() {
        $encryptedCodePoints = [85, 82, 89, 89, 66, 44, 32, 74, 66, 69, 89, 81, 33];

        $rot13Result = 'URYYB, JBEYQ!';

        $this->assertSame($rot13Result, $this->rot13Encryption->convertToLetters($encryptedCodePoints));
    }

}

