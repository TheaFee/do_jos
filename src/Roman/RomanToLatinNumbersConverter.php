<?php

namespace Roman;

class RomanToLatinNumbersConverter {

    protected $latinNumbers;

    public function merge(string $roman) {
        $validNumber = $this->getValidNumber($roman);
        $latinNumbers = $this->switchToLatinNumbers($validNumber);
        $validSemantic = $this->isSemanticValid($latinNumbers);
        $latinNumber = $this->calculate($validSemantic, $latinNumbers);

        return $latinNumber;
    }

    public function calculate(bool $validSemantic, array $latinNumbers) {

        if ($validSemantic) {
            return $this->performSubstractionRule($latinNumbers);
        } else {
            echo "Ordentlich arbeiten!!! Schlag mal die Regeln für römische Zahlen nach!!!";
            return false;
        }
    }

    public function getValidNumber(string $roman) {
        $validNumber = "";
        for ($i = 0, $j = strlen($roman); $i < $j; $i++) {
            $letter = substr($roman, $i, 1);
            $validLetter = $this->validateRomanNumber($letter);
            $validNumber .= $validLetter;
        }
        return $validNumber;
    }

    public function validateRomanNumber(string $letter) {
        $letterMatched = preg_match('/[MDCLXVI]/', $letter);
        if ($letterMatched) {
            return $letter;
        }
    }

    public function switchToLatinNumbers(string $validNumber) {
        $latinNumbers = array();
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

            array_push($latinNumbers, $latinNumber);
        }
        return $latinNumbers;
    }

    public function isSemanticValid(array $latinNumbers) {
        $amount = count($latinNumbers);
        for ($i = 0; $i < $amount; $i++) {
            $firstNumber = $latinNumbers[$i];
            $secondNumber = $latinNumbers[$i + 1];
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

    public function performSubstractionRule(array $latinNumbers) {
        $amount = count($latinNumbers);
        $result = 0;
        for ($i = 0; $i < $amount; $i++) {
            if ($i < $amount - 1 && $latinNumbers[$i] < $latinNumbers[$i + 1]) {
                $intermediateResult = $latinNumbers[$i + 1] - $latinNumbers[$i];
                $result += $intermediateResult;
                $i++;
            } else {
                $result += $latinNumbers[$i];
            }
        } return $result;
    }

}
