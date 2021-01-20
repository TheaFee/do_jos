<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Rot13;

/**
 * Description of Rot13Encryption
 *
 * @author thea
 */
class Rot13Encryption {

    protected $codePoints, $rot13;

    public function convertToAsciiUppercase($givenSentence) {

        $convertedSentence = iconv("UTF-8", "ASCII//TRANSLIT", $givenSentence);
        return $sentenceInUppercase = strtoupper($convertedSentence);
    }

    public function getCodePoints($sentenceInAscii) {
        $codePoints = array();
        $numberOfChars = strlen($sentenceInAscii);
        for ($i = 0; $i < $numberOfChars; $i++) {
            $letter = substr($sentenceInAscii, $i, 1);
            $asciiNumber = ord($letter);
            array_push($codePoints, $asciiNumber);
        } return $codePoints;
    }

    public function performEncryption($codePoints, $encryptionOffset) {
        $rot13 = array();
        $maxKey = max(array_keys($codePoints));
        for ($i = 0; $i <= $maxKey; $i++) {
            $codePoint = $codePoints[$i];
            $rot13CodePoint = $this->rot13($codePoint, $encryptionOffset);
            
            array_push($rot13, $rot13CodePoint);
        } return $rot13;
    }

    public function rot13($codePoint, $encryptionOffset) {
        if ($this->isCodePointALetter($codePoint)) {
            if (($codePoint + $encryptionOffset) > 90) {
                return $codePoint - $encryptionOffset;
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

    public function convertToLetters($rot13) {
        $rot13;
        $rot13Result = "";
        $maxKey = max(array_keys($rot13));
        for ($i = 0; $i <= $maxKey; $i++) {
            $rot13Lletter = chr($rot13[$i]);            
            $rot13Result .= $rot13Lletter;
        }
        return $rot13Result;
    }

}
