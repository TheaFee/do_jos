<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RotatingEncryption;

/**
 * Description of RotatingEncryption
 *
 * @author thea
 */
class RotatingEncryption {
    
    public function performRotEncryption(string $decrypted, int $encryptionOffset){
       $decryptedInUppercase = $this->convertToAsciiUppercase($decrypted);
       $codePoints = $this->getCodePoints($decryptedInUppercase);
       $rotatedCodePoints = $this->performEncryption($codePoints, $encryptionOffset);
       $encrypted = $this->convertToLetters($rotatedCodePoints);
       
       return $encrypted;
    }

    public function convertToAsciiUppercase(string $decrypted) {

        $convertedSentence = iconv("UTF-8", "ASCII//TRANSLIT", $decrypted);
        return $decryptedInUppercase = strtoupper($convertedSentence);
    }

    public function getCodePoints($decryptedInUppercase) {
        $codePoints = array();
        $numberOfChars = strlen($decryptedInUppercase);
        for ($i = 0; $i < $numberOfChars; $i++) {
            $letter = substr($decryptedInUppercase, $i, 1);
            $asciiNumber = ord($letter);
            array_push($codePoints, $asciiNumber);
        } return $codePoints;
    }

    public function performEncryption($codePoints, $encryptionOffset) {
        $rotatedCodePoints = array();
        $maxKey = max(array_keys($codePoints));
        for ($i = 0; $i <= $maxKey; $i++) {
            $codePoint = $codePoints[$i];
            $rotatedCodePoint = $this->rotation($codePoint, $encryptionOffset);

            array_push($rotatedCodePoints, $rotatedCodePoint);
        } return $rotatedCodePoints;
    }

    public function rotation($codePoint, $encryptionOffset) {
        if ($this->isCodePointALetter($codePoint)) {
            if (($codePoint + $encryptionOffset) > 90) {
                return 64 + $encryptionOffset - 90 + $codePoint;
            } else {
                return $codePoint + $encryptionOffset;
            }
        } else {
            return $codePoint;
        }
    }

    public function isCodePointALetter($codePoint) {
        if ($codePoint >= 65 && $codePoint <= 90) {
            return true;
        } else {
            return false;
        }
    }

    public function convertToLetters($rotatedCodePoints) {
        $encrypted = "";
        $maxKey = max(array_keys($rotatedCodePoints));
        for ($i = 0; $i <= $maxKey; $i++) {
            $rotatedLletter = chr($rotatedCodePoints[$i]);
            $encrypted .= $rotatedLletter;
        }
        return $encrypted;
    }

}
