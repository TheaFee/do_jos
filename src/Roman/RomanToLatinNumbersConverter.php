<?php

namespace Roman;

class RomanToLatinNumbersConverter {

    private array $latinNumbersArray;

    public function convertToLatinNumber(string $roman) {
        $validNumber = $this->getValidNumber($roman);
        $this->switchToLatinNumbers($validNumber);
        $latinNumber = $this->calculate();
        return $latinNumber;
    }

    public function calculate() {
        $isSemanticValid = $this->isSemanticValid();
        if ($isSemanticValid) {
            return $this->performSubstractionRule();
        } else {
            echo "Ordentlich arbeiten!!! Schlag mal die Regeln für römische Zahlen nach!!!";
            return false;
        }
    }

    public function getValidNumber(string $roman) {
        $validNumber = "";
        for ($i = 0, $j = strlen($roman); $i < $j; $i++) {
            $letter = substr($roman, $i, 1);
            $validLetter = $this->getValidRomanLetter($letter);

            $validNumber .= $validLetter;
        }
        return $validNumber;
    }


    public function getValidRomanLetter(string $letter) {

        $letterMatched = preg_match('/[MDCLXVI]/', $letter);
        if ($letterMatched) {
            return $letter;
        }
    }

    public function switchToLatinNumbers(string $validNumber) {
        for ($i = 0; $i < strlen($validNumber); $i++) {
            $letter = substr($validNumber, $i, 1);
            switch ($letter) {
                case $letter === "I":
                    $latinNumber = 1;
                    break;
                case $letter === "V":
                    $latinNumber = 5;
                    break;
                case $letter === "X":
                    $latinNumber = 10;
                    break;
                case $letter === "L":
                    $latinNumber = 50;
                    break;
                case $letter === "C";
                    $latinNumber = 100;
                    break;
                case $letter === "D";
                    $latinNumber = 500;
                    break;
                case $letter === "M":
                    $latinNumber = 1000;
            }

            array_push($this->latinNumbersArray, $latinNumber);
        }

    }

    public function isSemanticValid() {
        $amount = count($this->latinNumbersArray);
        for ($i = 0; $i < $amount; $i++) {
            $firstNumber = $this->latinNumbersArray[$i];
            $secondNumber = $this->latinNumbersArray[$i + 1];
            switch ([$firstNumber, $secondNumber]):
                case $firstNumber === 1 && ($secondNumber === 5 || $secondNumber === 10):
                    return true;
                case $firstNumber === 10 && (($secondNumber === 50) || ($secondNumber === 100)):
                    return true;
                case $firstNumber === 100 && ($secondNumber === 500 || $secondNumber === 1000):
                    return true;
                default :
                    return false;
            endswitch;
        }
    }

    public function performSubstractionRule() {
        $amount = count($this->latinNumbersArray);
        $result = 0;
        for ($i = 0; $i < $amount; $i++) {
            if ($i < $amount - 1 && $this->latinNumbersArray[$i] < $this->latinNumbersArray[$i + 1]) {
                $intermediateResult = $this->latinNumbersArray[$i + 1] - $this->latinNumbersArray[$i];
                $result += $intermediateResult;
                $i++;
            } else {
                $result += $this->latinNumbersArray[$i];
            }
        } return $result;
    }

}
