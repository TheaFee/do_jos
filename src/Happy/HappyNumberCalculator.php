<?php

namespace Happy;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HappyNumberCalculator {

    public function toArray($number) {

        $numberAsArray = array_map('intval', str_split($number));

        return $numberAsArray;
    }

    public function evaluateHappyNumberEquation($number) {
        $solution;
        do {
            $solution = 0;
            $numberAsArray = $this->toArray($number);

            $maxKey = max(array_keys($numberAsArray));
            for ($i = 0; $i <= $maxKey; $i++) {

                $squareNumber = pow($numberAsArray[$i], 2);
                $solution += $squareNumber;

            }
            $number = $solution;

        } while ($solution !== 1 && $solution !== 4);
        
        return $solution;
    }
    
    public function isNumberHappy($number){
        $result = $this->evaluateHappyNumberEquation($number);
        return $result === 1;
    }
    
    public function findAllHappyNumbersBetween($beginNumber, $endNumber){
        $result = array();
        for($beginNumber;$beginNumber < $endNumber; $beginNumber++){
            $isNumberHappy = $this->isNumberHappy($beginNumber);
            
            if ($isNumberHappy=== true){
            array_push($result, $beginNumber);
            }
        }
        return $result;
    }

}
   